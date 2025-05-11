@extends('layouts.dashboard')


@section('content')
<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Ad Accounts</h1>

  <a href="{{ route('ad_accounts.create') }}"
     class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
    + New Ad Account
  </a>

  @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
      {{ session('success') }}
    </div>
  @endif

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow rounded">
      <thead>
        <tr class="bg-gray-200 text-gray-700">
          <th class="py-2 px-4">Name</th>
          <th class="py-2 px-4">Currency</th>
          <th class="py-2 px-4">Balance</th>
        </tr>
      </thead>
      <tbody>
        @foreach($accounts as $acct)
        <tr class="border-b">
          <td class="py-2 px-4">{{ $acct->name }}</td>
          <td class="py-2 px-4">{{ $acct->currency }}</td>
          <td class="py-2 px-4">
            {{ number_format($acct->balance, 2) }} {{ $acct->currency }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
