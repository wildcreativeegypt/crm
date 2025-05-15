{{-- resources/views/personal/expenses/index.blade.php --}}
@extends('layouts.dashboard')

@section('title','My Daily Expenses')

@section('content')
<div class="p-6 space-y-6">
  <div class="flex justify-between items-center">
    <h1 class="text-2xl font-bold">My Daily Expenses</h1>
    <a href="{{ route('personal.expenses.create') }}" class="btn btn-primary">+ New Expense</a>
  </div>

  <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-base-100 p-4 shadow rounded">
    <div class="form-control">
      <label class="label"><span class="label-text">Start Date</span></label>
      <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered" />
    </div>
    <div class="form-control">
      <label class="label"><span class="label-text">End Date</span></label>
      <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered" />
    </div>
    <div class="md:col-span-2 form-control">
      <label class="label"><span class="label-text">Keyword</span></label>
      <input type="text" name="search" placeholder="Category or Notes…" value="{{ request('search') }}" class="input input-bordered" />
    </div>
    <div class="md:col-span-4 text-right space-x-2">
      <button class="btn btn-primary">Filter</button>
      <a href="{{ route('personal.expenses.index') }}" class="btn btn-outline">Clear</a>
    </div>
  </form>

  <div class="overflow-x-auto bg-base-100 shadow rounded">
    <table class="table table-zebra w-full">
      <thead><tr><th>Date</th><th>Category</th><th>Amount</th><th>Notes</th></tr></thead>
      <tbody>
        @forelse($expenses as $e)
          <tr>
            <td>{{ $e->date }}</td>
            <td>{{ $e->category }}</td>
            <td>{{ number_format($e->amount,2) }}</td>
            <td>{{ $e->notes }}</td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center">No expenses.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $expenses->links() }}</div>
</div>
@endsection
