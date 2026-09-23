<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AdminMagicLoginController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.login');
    }

    public function sendLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar.']);
        }

        $url = URL::temporarySignedRoute(
            'admin.magic-login',
            now()->addMinutes(15),
            ['user' => $user->id]
        );

        // Di environment local, langsung tampilkan link-nya di halaman
        // supaya tidak perlu konfigurasi SMTP untuk testing.
        if (app()->environment('local')) {
            return back()->with('magic_link', $url);
        }

        Mail::raw("Klik link berikut untuk login ke panel admin: {$url}", function ($message) use ($user) {
            $message->to($user->email)->subject('Link Login Admin');
        });

        return back()->with('success', 'Link login sudah dikirim ke email Anda.');
    }

    public function login(User $user)
    {
        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
}