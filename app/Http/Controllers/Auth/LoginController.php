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

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 2) {
            return redirect()->route('parent.dashboard');
        } elseif ($user->role === 1) {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role === 0) {
            return redirect()->route('admin.dashboard');
        }else {
            return redirect()->route('home');
        }
    }
}



