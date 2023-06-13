<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        return 'email';
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Check if the input is an email
        if (filter_var($credentials[$this->username()], FILTER_VALIDATE_EMAIL)) {
            // Attempt to authenticate using email and password
            return $this->guard()->attempt(
                $credentials,
                $request->filled('remember')
            );
        } else {
            // Attempt to authenticate using name and password
            return $this->guard()->attempt(
                ['name' => $credentials[$this->username()], 'password' => $credentials['password']],
                $request->filled('remember')
            );
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors($errors);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'parent') {
            return redirect()->route('parent.dashboard');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }else {
            return redirect()->route('home');
        }
    }
    
}
