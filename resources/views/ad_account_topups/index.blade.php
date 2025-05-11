@extends('layouts.dashboard')


@section('content')
<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Ad Account Top-ups</h1>

  <a href="{{ route('ad_account_topups.create') }}"
     class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
    + Add Top-Up
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
          <th class="py-2 px-4">Account</th>
          <th class="py-2 px-4">Date</th>
          <th class="py-2 px-4">Amount (EGP)</th>
          <th class="py-2 px-4">Notes</th>
        </tr>
      </thead>
      <tbody>
        @foreach($topups as $t)
        <tr class="border-b">
          <td class="py-2 px-4">{{ $t->account->name }}</td>
          <td class="py-2 px-4">{{ $t->date }}</td>
          <td class="py-2 px-4">{{ number_format($t->amount,2) }}</td>
          <td class="py-2 px-4">{{ $t->notes }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
