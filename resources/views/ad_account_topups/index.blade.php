{{-- resources/views/ad_account_topups/index.blade.php --}}
@extends('layouts.dashboard')

@section('title','Top-Ups')

@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Ad Account Top-Ups</h1>
    <a href="{{ route('ad_account_topups.create') }}" class="btn btn-primary">+ Add Top-Up</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
  @endif

  <div class="overflow-x-auto bg-base-100 shadow rounded">
    <table class="table table-zebra w-full">
      <thead><tr><th>Account</th><th>Date</th><th>Amount</th><th>Notes</th></tr></thead>
      <tbody>
        @foreach($topups as $t)
          <tr>
            <td>{{ $t->account->name }}</td>
            <td>{{ $t->date }}</td>
            <td>{{ number_format($t->amount,2) }}</td>
            <td>{{ $t->notes }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
