<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    // داشبۆرد
    public function index(): View
    {
        $users = User::paginate(20); 
        return view('admin.dashboard', compact('users'));
    }

    // toggle status
    public function toggleStatus(string $encryptedId): RedirectResponse
    {
        $id = Crypt::decryptString($encryptedId);
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'نەتوانیت خۆت قەفل بکەیت.']);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', "Status ی {$user->name} گۆڕدرا");
    }

    // update role
    public function updateRole(string $encryptedId): RedirectResponse
    {
        $id = Crypt::decryptString($encryptedId);
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'نەتوانیت رۆل خۆت بگۆڕیت.']);
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('success', "رۆلی {$user->name} گۆڕدرا");
    }

    // update user
    public function update(Request $request, string $encryptedId): RedirectResponse
    {
        $id = Crypt::decryptString($encryptedId);
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|in:user,admin',
            'is_active' => 'nullable|boolean',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        if ($request->has('is_active')) {
            $user->is_active = $request->is_active;
        }

        $user->save();

        return back()->with('success', "Profile نوێکرا");
    }

    // delete user
    public function destroy(string $encryptedId): RedirectResponse
    {
        $id = Crypt::decryptString($encryptedId);
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'نەتوانیت خۆت بسڕیتەوە.']);
        }

        // سڕینەوەی فایلی profile ی یووزەر ئەگەر هەبوو
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // سڕینەوەی هەموو فایلەکانی تر کە پەیوەندیان بە یوزەرەوە
        if ($user->cover_image && Storage::disk('public')->exists($user->cover_image)) {
            Storage::disk('public')->delete($user->cover_image);
        }

        if ($user->identity_card && Storage::disk('public')->exists($user->identity_card)) {
            Storage::disk('public')->delete($user->identity_card);
        }

        if ($user->attachments) {
            $attachments = json_decode($user->attachments, true) ?? [];
            foreach ($attachments as $attachment) {
                if (Storage::disk('public')->exists($attachment)) {
                    Storage::disk('public')->delete($attachment);
                }
            }
        }

        // سڕینەوەی فولدەری تایبەتی یوزەر
        $userFolder = 'users/' . $user->id;
        if (Storage::disk('public')->exists($userFolder)) {
            Storage::disk('public')->deleteDirectory($userFolder);
        }

        // سڕینەوەی فولدەری fonts ی یوزەر
        $userFontsFolder = 'fonts/user_' . $user->id;
        if (Storage::disk('public')->exists($userFontsFolder)) {
            Storage::disk('public')->deleteDirectory($userFontsFolder);
        }

        $user->delete();

        return back()->with('success', "User و هەموو فایلەکانی سڕایەوە");
    }

    // edit form
    public function edit(string $encryptedId): View
    {
        $id = Crypt::decryptString($encryptedId);
        $user = User::findOrFail($id);

        $canEditRoleStatus = auth()->user()->role === 'admin'
            && auth()->id() !== $user->id;

        return view('admin.user_edit', compact('user', 'canEditRoleStatus'));
    }
}
