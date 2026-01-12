<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        // Jika user sudah login, langsung lempar ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // Return view yang tadi Anda buat (resources/views/auth/login.blade.php)
        return view('auth.login');
    }

    /**
     * Memproses data login yang dikirim dari form.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek "Remember Me"
        $remember = $request->has('remember');

        // 3. Proses otentikasi
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect ke dashboard jika sukses
            return redirect()->route('dashboard');
        }

        // 4. Jika gagal, kembalikan ke halaman login dengan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
