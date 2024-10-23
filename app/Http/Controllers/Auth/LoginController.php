<?php

namespace App\Http\Controllers\Auth;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->intended($this->redirectTo);
        }
    
        $agent = new Agent();
    
        if ($agent->isMobile()) {
            return response()->view('mobiles.auth.login')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                ->header('Cache-Control', 'post-check=0, pre-check=0')
                ->header('Pragma', 'no-cache');
        }
    
        return response()->view('auth.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Cache-Control', 'post-check=0, pre-check=0')
            ->header('Pragma', 'no-cache');
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
            return redirect()->route('login');
        }
    
        return redirect()->route('login');
    }
    
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [
            $this->username() => ['Email atau NIK dan password yang Anda masukkan tidak cocok.'],
        ];
        throw ValidationException::withMessages($errors);
    }
}
