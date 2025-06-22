<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class ProfileController extends Controller
{

    public function show()
{
    return view('profile.show', ['user' => Auth::user()]);
}

public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . Auth::id(),
        'phone' => 'nullable|string',
        'address' => 'nullable|string',
        'profile_photo' => 'nullable|image|max:2048',
    ]);

    $user = Auth::user();

    if ($request->hasFile('profile_photo')) {
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $path;
    }

    $user->update($request->only('name', 'email', 'phone', 'address'));

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

}