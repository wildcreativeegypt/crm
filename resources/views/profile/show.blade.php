@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
<div class="container mx-auto p-6 bg-base-200 dark:bg-gray-900">
    <h1 class="text-2xl font-bold mb-4">Profile</h1>
    <div class="p-4 border rounded-lg shadow-sm bg-base-100">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Joined:</strong> {{ $user->created_at->format('F d, Y') }}</p>
    </div>
</div>
@endsection