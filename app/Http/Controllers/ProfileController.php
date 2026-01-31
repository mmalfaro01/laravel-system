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
    
    // Update basic fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;

    // Handle profile photo upload
    if ($request->hasFile('profile_photo')) {
        // Delete old photo if exists
        if ($user->profile_photo && file_exists(public_path('images/profiles/' . $user->profile_photo))) {
            unlink(public_path('images/profiles/' . $user->profile_photo));
        }
        
        // Store new photo
        $filename = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
        $request->file('profile_photo')->move(public_path('images/profiles'), $filename);
        $user->profile_photo = $filename;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

}