<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\WebCart;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = $request->user();

        if ($user->status === 'inactive') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Show SweetAlert for inactive users
            Alert::error('Error', 'Your account has been deactivated!')->showConfirmButton('OK', '#CE7F36');

            return redirect()->route('home');
        }

        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '<>', $request->session()->getId())
            ->delete();

        $request->session()->regenerate();

        $url = '';

        if ($user->role === 'admin') {
            $url = '/admin/dashboard';
            toast('Sign in Successful', 'success');
        } elseif ($user->role === 'employee') {
            $url = '/employee/dashboard';
            toast('Sign in Successful', 'success');
        } elseif ($user->role === 'customer') {
            $url = '/';
            Alert::success('Success', 'Sign in Successful!')->showConfirmButton('OK', '#CE7F36');
        }

        return redirect()->intended($url);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->clearCartItems(auth()->user());
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function clearCartItems($user)
    {
        WebCart::where('user_id', $user->id)->delete();
    }

}
