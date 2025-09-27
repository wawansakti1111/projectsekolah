<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

        $request->session()->regenerate();

        // ▼▼▼ Mengubah logika redirect ▼▼▼
        $user = Auth::user();

        if ($user->role === 'siswa') {
            return redirect()->intended(route('siswa.dashboard'));
        }

        if ($user->role === 'guru') {
            return redirect()->intended(route('guru.dashboard'));
        }
        if ($user->role === 'kepsek') {
            return redirect()->intended(route('kepsek.dashboard'));
        }

        return redirect()->intended(route('home'));
        // ▲▲▲ Akhir dari logika redirect yang diperbarui ▲▲▲
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
