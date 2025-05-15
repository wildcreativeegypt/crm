@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Facebook Accounts</h1>
    <a href="{{ route('facebook-accounts.create') }}" class="btn btn-primary mb-3">Add New Account</a>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Account ID</th>
                    <th>Current Balance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->account_id }}</td>
                        <td>${{ number_format($account->current_balance, 2) }}</td>
                        <td>
                            <a href="{{ route('facebook-accounts.edit', $account->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('facebook-accounts.destroy', $account->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error btn-sm" onclick="return confirm('Are you sure you want to delete this account?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection