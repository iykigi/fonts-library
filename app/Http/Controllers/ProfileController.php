<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * 🎯 ناردنی ئیمەیڵی سەلماندن بۆ ئەکاونت
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendVerificationEmail(Request $request): RedirectResponse
    {
        // ئەگەر ئەکاونتەکە پێشتر سەلمێنرابوو
        if ($request->user()->hasVerifiedEmail()) {
            return Redirect::route('profile.edit')->with('status', 'email-already-verified');
        }

        // ناردنی ئیمەیڵی سەلماندن
        $request->user()->sendEmailVerificationNotification();

        // گەڕانەوە لەگەڵ پەیامی سەرکەوتن
        return Redirect::route('profile.edit')->with('status', 'verification-link-sent');
    }

    /**
     * 🎯 دووبارە ناردنی ئیمەیڵی سەلماندن (ئەگەر ویستت)
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function resendVerificationEmail(Request $request): RedirectResponse
    {
        // دڵنیابوونەوە کە ئەکاونتەکە نەسەلمێنراوە
        if ($request->user()->hasVerifiedEmail()) {
            return Redirect::route('profile.edit')->with('status', 'email-already-verified');
        }

        // دڵنیابوونەوە لەوەی کە دوایین ئیمەیڵ لە ١ خولەکی ڕابردوودا نەنێردراوە
        $lastEmailSent = session('last_verification_email_sent');
        
        if ($lastEmailSent && now()->diffInSeconds($lastEmailSent) < 60) {
            return Redirect::route('profile.edit')->with('status', 'verification-link-throttle');
        }

        // ناردنی ئیمەیڵ
        $request->user()->sendEmailVerificationNotification();
        
        // تۆمارکردنی کاتی ناردن بۆ خێراکردن (Throttle)
        session(['last_verification_email_sent' => now()]);

        return Redirect::route('profile.edit')->with('status', 'verification-link-sent');
    }
}