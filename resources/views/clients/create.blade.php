@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Add New Client</h1>
    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium">Name</label>
                    <input type="text" name="name" id="name" class="input input-bordered w-full" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" id="email" class="input input-bordered w-full">
                </div>
                <div class="mb-4">
                    <label for="facebook_account_id" class="block text-sm font-medium">Facebook Account</label>
                    <select name="facebook_account_id" id="facebook_account_id" class="select select-bordered w-full" required>
                        <option value="">Select a Facebook Account</option>
                        @foreach ($facebookAccounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary">Add Client</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection