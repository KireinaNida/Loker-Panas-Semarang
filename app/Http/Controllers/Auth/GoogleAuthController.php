<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    /**
     * Redirect user to Google OAuth consent screen.
     */
    public function redirect(): RedirectResponse
    {
        // For local development with invalid credentials, redirect directly to mock login
        if (config('app.env') === 'local') {
            return redirect()->route('auth.google.mock-view');
        }

        try {
            return Socialite::driver('google')->redirect();
        } catch (Throwable $e) {
            Log::error('Google OAuth Redirect Error: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            
            if (config('app.env') === 'local') {
                return redirect()->route('auth.google.mock-view')->with('error', 'Redirect Google gagal: ' . $e->getMessage());
            }

            return redirect()->route('login')->with('error', 'Gagal menghubungkan ke Google. Silakan coba lagi nanti.');
        }
    }

    /**
     * Handle callback from Google OAuth.
     */
    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            if (!$googleUser || !$googleUser->getEmail()) {
                return redirect()->route('login')->with('error', 'Gagal mengambil data profil Google.');
            }

            // Find existing user by google_id OR email
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                // Link account if google_id is not set yet, or update/verify email
                $user->update([
                    'google_id' => $user->google_id ?: $googleUser->getId(),
                    'avatar' => $user->avatar ?: $googleUser->getAvatar(),
                    'email_verified_at' => $user->email_verified_at ?: now(),
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'User',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'role' => 'user',
                    'email_verified_at' => now(),
                    'password' => null, // Password can be null for Google social login
                ]);
            }

            Auth::login($user, true);
            request()->session()->regenerate();

            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard', absolute: false))->with('success', 'Selamat datang di Dashboard Admin!');
            }

            return redirect()->intended(route('beranda', absolute: false))->with('success', 'Berhasil masuk dengan akun Google.');
        } catch (Throwable $e) {
            Log::error('Google OAuth Callback Error: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            // Fallback to mock view if we are on local and callback failed
            if (config('app.env') === 'local') {
                return redirect()->route('auth.google.mock-view')->with('error', 'Google OAuth gagal (' . $e->getMessage() . '). Mengalihkan ke mode pengembang...');
            }

            return redirect()->route('login')->with('error', 'Gagal masuk dengan Google: ' . $e->getMessage());
        }
    }

    /**
     * Show mock login panel in local environment.
     */
    public function mockView()
    {
        if (config('app.env') !== 'local') {
            abort(403, 'Mock login is only available in local environment.');
        }

        $users = User::all();
        return view('auth.google-mock', compact('users'));
    }

    /**
     * Handle mock login request.
     */
    public function mockLogin(\Illuminate\Http\Request $request): RedirectResponse
    {
        if (config('app.env') !== 'local') {
            abort(403, 'Mock login is only available in local environment.');
        }

        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $name = $request->input('name') ?? explode('@', $email)[0];

        // Find user by email
        $user = User::where('email', $email)->first();

        if ($user) {
            // Link account to mock google_id
            if (!$user->google_id) {
                $user->update([
                    'google_id' => 'mock_google_' . rand(100000, 999999),
                    'avatar' => $user->avatar ?: 'https://www.gravatar.com/avatar/' . md5($email) . '?d=mp',
                    'email_verified_at' => $user->email_verified_at ?: now(),
                ]);
            }
        } else {
            // Create user
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'google_id' => 'mock_google_' . rand(100000, 999999),
                'avatar' => 'https://www.gravatar.com/avatar/' . md5($email) . '?d=mp',
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => null,
            ]);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard', absolute: false))->with('success', 'Berhasil masuk sebagai Admin (Simulasi).');
        }

        return redirect()->intended(route('beranda', absolute: false))->with('success', 'Berhasil masuk sebagai ' . $user->name . ' (Simulasi Google).');
    }
}
