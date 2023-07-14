<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Enums\CentyOtpVerified;
use App\Jobs\SendUserOtp;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $login = request()->input('centy_plus_id'); // Get the input value from the login form

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'centy_plus_id'; // Determine if the input is an email or centy_plus_id

        request()->merge([$fieldType => $login]); // Merge the input value into the request

        return $fieldType; // Return the field type (email or centy_plus_id)
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        return $this->guard()->attempt(
            $credentials,
            $request->filled('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only('centy_plus_id', 'remember'))
            ->withErrors($errors);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->first_login) {
            return redirect()->route('change.password');
        }
        if ($user->centy_plus_otp_verified->value == CentyOtpVerified::INACTIVE || $user->centy_plus_otp_verified->value === CentyOtpVerified::SENT){
            $user = User::find($user->id);
            $user->centy_plus_otp = rand(1000, 9999);
            $user->save();

            // Send OTP to users phone number
            dispatch(new SendUserOtp($user));

            // Redirect user to verify otp view             
            return redirect()->route('otp.enter');
        } elseif ($user->role === 'parent') {
            return redirect()->route('parent.dashboard');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } else {
            if ($user->role === 'parent') {
                return redirect()->route('parent.dashboard');
            } elseif ($user->role === 'teacher') {
                return redirect()->route('teacher.dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'student') {
                return redirect()->route('student.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

    }

    public function showPasswordResetForm()
    {
        return view('auth.passwords.reset');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'digits:4', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->first_login = false;
        $user->save();

        return redirect()->route('login')->with('status', 'Password reset successfully! Please Login with new password.');
    }

    public function enterOTP()
    {
        return view('auth.otp');
    }

    public function validateOTP(Request $request)
    {
        $request->validate([
            'centy_plus_otp' => 'required', 'digits:4', 'confirmed',
        ]);

        $user = Auth::user();
        
        if ($user->centy_plus_otp === $request->centy_plus_otp){
            $user->centy_plus_otp = null;
            $user->centy_plus_otp_status = CentyOtpVerified::VERIFIED;
            $user->centy_plus_otp_verified_at = Carbon::now();
            $user->save();

            return redirect()->route('login')->with('status', 'Login Successful!!');
        } else {
            $user->centy_plus_otp = null;
            $user->centy_plus_otp_status = CentyOtpVerified::INACTIVE;
            $user->save();

            return redirect()->route('login')->with('status', 'Login again to get new OTP!.');
        }
    }

}
