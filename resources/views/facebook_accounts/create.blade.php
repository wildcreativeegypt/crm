@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Add New Facebook Account</h1>
    <form action="{{ route('facebook-accounts.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="form-control">
            <label for="name" class="label">
                <span class="label-text">Account Name</span>
            </label>
            <input type="text" name="name" id="name" class="input input-bordered w-full" required>
        </div>
        <div class="form-control">
            <label for="account_id" class="label">
                <span class="label-text">Account ID</span>
            </label>
            <input type="text" name="account_id" id="account_id" class="input input-bordered w-full" required>
        </div>
        <div class="form-control">
            <label for="current_balance" class="label">
                <span class="label-text">Current Balance</span>
            </label>
            <input type="number" step="0.01" name="current_balance" id="current_balance" class="input input-bordered w-full">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection