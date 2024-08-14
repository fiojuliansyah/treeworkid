<?php

namespace App\Http\Controllers\Auth;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/moble/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $agent = new Agent();
    
        if (Auth::check()) {
            if ($agent->isMobile()) {
                return redirect()->route('mobile.home');
            }
            return redirect()->intended($this->redirectTo);
        }
    
        if ($agent->isMobile()) {
            return view('mobiles.auth.login');
        }
    
        return view('auth.login');
    }
    

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
        ]);
    }

    public function username()
    {
        $login = request()->input('login');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'employee_nik';

        request()->merge([$field => $login]);

        return $field;
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function authenticated(Request $request, $user)
    {
        $agent = new Agent();

        if ($agent->isMobile()) {
            if (!$user->can('view-mobile')) {
                return redirect('/');
            }
            return redirect()->route('mobile.home');
        } elseif ($agent->isDesktop()) {
            if (!$user->can('view-desktop')) {
                return redirect('/');
            }
            return redirect()->intended($this->redirectTo);
        } else {
            if (!$user->can('view-desktop')) {
                return redirect('/');
            }
            return redirect()->intended($this->redirectTo);
        }
    }

    public function logout(Request $request)
    {
        $guard = $this->guard();
        
        $guard->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        if ((new Agent())->isMobile()) {
            return redirect()->route('mobile.walkthrough');
        }
    
        return redirect('/welcome');
    }
    
}
