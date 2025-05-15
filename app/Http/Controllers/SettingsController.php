<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show the settings page.
     */
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();
        
        // Return the settings view and pass the user data
        return view('settings.index', compact('user'));
    }

    /**
     * Update the user's settings.
     */
    public function update(Request $request)
    {
        // Validate the submitted data
        $validated = $request->validate([
            'email_notifications' => 'required|in:enabled,disabled',
            'profile_visibility' => 'required|in:public,private',
        ]);

        // Retrieve the authenticated user
        $user = $request->user();

        // Debugging: Log the submitted data to ensure the correct values are being passed
        \Log::info('Settings Update Request', [
            'email_notifications' => $validated['email_notifications'],
            'profile_visibility' => $validated['profile_visibility'],
            'user_id' => $user->id,
        ]);

        // Update the user's settings
        $user->email_notifications = $validated['email_notifications'];
        $user->profile_visibility = $validated['profile_visibility'];
        $user->save();

        // Redirect back to the settings page with a success message
        return redirect()->route('settings.index')->with('status', 'Settings updated successfully.');
    }
}