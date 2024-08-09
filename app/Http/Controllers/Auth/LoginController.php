<?php

namespace App\Http\Controllers\Auth;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $agent = new Agent();

        if ($agent->isMobile()) {
            return view('mobiles.auth.login');
        }

        return view('auth.login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|email|max:255',
            'password' => 'required|string',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
            'string' => 'Kolom :attribute harus berupa teks.',
        ]);
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
        $agent = new Agent();

        // Log out the user
        $this->guard()->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        if ($agent->isMobile()) {
            return redirect()->route('mobile.walkthrough');
        }

        return redirect('/welcome');
    }
}
