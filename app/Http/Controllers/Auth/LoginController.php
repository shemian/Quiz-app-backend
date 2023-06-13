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
