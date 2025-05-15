{{-- resources/views/ad_accounts/index.blade.php --}}
@extends('layouts.dashboard')

@section('title','Ad Accounts')

@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Ad Accounts</h1>
    <a href="{{ route('ad_accounts.create') }}" class="btn btn-primary">+ New Ad Account</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
  @endif

  <div class="overflow-x-auto bg-base-100 shadow rounded">
    <table class="table table-zebra w-full">
      <thead>
        <tr><th>Name</th><th>Currency</th><th>Balance</th></tr>
      </thead>
      <tbody>
        @foreach($accounts as $acct)
          <tr>
            <td>{{ $acct->name }}</td>
            <td>{{ $acct->currency }}</td>
            <td>{{ number_format($acct->balance,2) }} {{ $acct->currency }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
