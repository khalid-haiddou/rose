<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * Show the reset password request form (GET /forgot-password)
     */
    public function showRequestForm()
    {
        return view('reset-password'); // blade form to submit email
    }

    /**
     * Handle sending the reset link to the email (POST /forgot-password)
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show the actual password reset form (GET /reset-password/{token})
     */
    public function showResetForm($token)
    {
        $email = request('email');
        return view('reset-password-form', compact('token', 'email'));
    }

    /**
     * Handle updating the password (POST /reset-password)
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Mot de passe mis à jour avec succès.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
