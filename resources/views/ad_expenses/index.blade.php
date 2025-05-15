{{-- resources/views/ad_expenses/index.blade.php --}}
@extends('layouts.dashboard')

@section('title','Ad Expenses')

@section('content')
<div class="p-6 space-y-6">
  <h1 class="text-2xl font-bold">Ad Expenses</h1>
  <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-base-100 p-4 shadow rounded">
    <div class="form-control">
      <label class="label"><span class="label-text">Account</span></label>
      <select name="account_id" class="select select-bordered">
        <option value="">All Accounts</option>
        @foreach($accounts as $acct)
          <option value="{{ $acct->id }}" {{ request('account_id')==$acct->id?'selected':'' }}>
            {{ $acct->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-control">
      <label class="label"><span class="label-text">Start Date</span></label>
      <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered" />
    </div>
    <div class="form-control">
      <label class="label"><span class="label-text">End Date</span></label>
      <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered" />
    </div>
    <div class="form-control">
      <label class="label"><span class="label-text">Keyword</span></label>
      <input type="text" name="search" placeholder="Notes…" value="{{ request('search') }}" class="input input-bordered" />
    </div>
    <div class="md:col-span-4 text-right space-x-2">
      <button class="btn btn-primary">Apply Filters</button>
      <a href="{{ route('ad_expenses.index') }}" class="btn btn-outline">Clear</a>
    </div>
  </form>

  <div class="overflow-x-auto bg-base-100 shadow rounded">
    <table class="table table-zebra w-full">
      <thead><tr><th>Date</th><th>Account</th><th>Amount</th><th>Fee</th><th>Total</th><th>Notes</th></tr></thead>
      <tbody>
        @forelse($expenses as $e)
          <tr>
            <td>{{ $e->date }}</td>
            <td>{{ $e->account->name }}</td>
            <td>{{ number_format($e->amount,2) }}</td>
            <td>{{ number_format($e->credit_card_fee_amount,2) }}</td>
            <td>{{ number_format($e->total_cost,2) }}</td>
            <td>{{ $e->notes }}</td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center">No expenses.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $expenses->links() }}</div>
</div>
@endsection
