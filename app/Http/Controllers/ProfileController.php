<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class ProfileController extends Controller
{
    public function edit()
    {
       
        $user = Auth::user();
        $name = $user->name;
        return view('myprofile', compact('user'))->with('name', $name);
    }

    /**
     * Update the user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate incoming request
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image file
            'phone_number' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:255',
        ]);

        // Handle avatar upload if provided
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Update other fields
        $user->phone_number = $request->input('phone_number');
        $user->description = $request->input('description');
      //  $user->save();

        // Set success message
      //  $request->session()->flash('success', 'Profile updated successfully.');

        // Redirect back to profile edit page
        return redirect()->route('profile.edit');
    }
}
