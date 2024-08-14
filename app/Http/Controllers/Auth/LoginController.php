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

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $agent = new Agent();

        // Jika pengguna sudah login, arahkan ke halaman yang sesuai
        if (Auth::check()) {
            if ($agent->isMobile()) {
                return redirect()->route('mobile.home');
            }
            return redirect()->intended($this->redirectTo);
        }

        // Tampilkan form login sesuai perangkat
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
                return redirect()->route('mobile.walkthrough'); // Mengarahkan ke walkthrough jika hak akses tidak sesuai
            }
            return redirect()->route('mobile.home'); // Halaman untuk mobile
        }
    
        if ($agent->isDesktop()) {
            if (!$user->can('view-desktop')) {
                return redirect('/'); // Halaman default jika hak akses tidak sesuai
            }
            return redirect()->intended($this->redirectTo); // Halaman default setelah login
        }
    
        // Default untuk perangkat lainnya
        return redirect()->intended($this->redirectTo);
    }
    

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $agent = new Agent();

        if ($agent->isMobile()) {
            return redirect()->route('mobile.walkthrough');
        }

        return redirect('/welcome');
    }
}
