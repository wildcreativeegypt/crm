@extends('layouts.dashboard')

@section('title', 'Settings')

@section('content')
<div class="container mx-auto p-6 bg-base-200">
    <h1 class="text-2xl font-bold mb-6 text-base-content">Settings</h1>
    <div class="p-6 bg-base-100 rounded-lg shadow">
        <p class="text-base-content mb-4">Update your settings below:</p>

        {{-- Settings Form --}}
        <form method="POST" action="{{ route('settings.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Email Notifications --}}
            <div class="form-control w-full">
                <label for="email_notifications" class="label">
                    <span class="label-text text-base-content">Email Notifications</span>
                </label>
                <select id="email_notifications" name="email_notifications" class="select select-bordered">
                    <option value="enabled" {{ old('email_notifications', $user->email_notifications) == 'enabled' ? 'selected' : '' }}>Enabled</option>
                    <option value="disabled" {{ old('email_notifications', $user->email_notifications) == 'disabled' ? 'selected' : '' }}>Disabled</option>
                </select>
            </div>

            {{-- Profile Visibility --}}
            <div class="form-control w-full">
                <label for="profile_visibility" class="label">
                    <span class="label-text text-base-content">Profile Visibility</span>
                </label>
                <select id="profile_visibility" name="profile_visibility" class="select select-bordered">
                    <option value="public" {{ old('profile_visibility', $user->profile_visibility) == 'public' ? 'selected' : '' }}>Public</option>
                    <option value="private" {{ old('profile_visibility', $user->profile_visibility) == 'private' ? 'selected' : '' }}>Private</option>
                </select>
            </div>

            {{-- Save Button --}}
            <div class="form-control">
                <button type="submit" class="btn btn-primary w-full">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection