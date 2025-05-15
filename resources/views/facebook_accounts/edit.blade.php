@extends('layouts.dashboard')

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Edit Facebook Account</h1>
    <form action="{{ route('facebook-accounts.update', $facebookAccount->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="form-control">
            <label for="name" class="label">
                <span class="label-text">Account Name</span>
            </label>
            <input type="text" name="name" id="name" class="input input-bordered w-full" value="{{ $facebookAccount->name }}" required>
        </div>

        <div class="form-control">
            <label for="account_id" class="label">
                <span class="label-text">Account ID</span>
            </label>
            <input type="text" name="account_id" id="account_id" class="input input-bordered w-full" value="{{ $facebookAccount->account_id }}" required>
        </div>

        <div class="form-control">
            <label for="current_balance" class="label">
                <span class="label-text">Current Balance</span>
            </label>
            <input type="number" step="0.01" name="current_balance" id="current_balance" class="input input-bordered w-full" value="{{ $facebookAccount->current_balance }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection