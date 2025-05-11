@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4 space-y-4">

  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">My Daily Expenses</h1>
    <a href="{{ route('personal.expenses.create') }}"
       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
      + New Expense
    </a>
  </div>

  <!-- Filter Form -->
  <form method="GET"
        class="bg-white p-4 shadow rounded grid grid-cols-1 md:grid-cols-4 gap-4">
    <div>
      <label class="block text-sm font-medium">Start Date</label>
      <input type="date" name="start_date"
             value="{{ $start->toDateString() }}"
             class="w-full border rounded p-2">
    </div>
    <div>
      <label class="block text-sm font-medium">End Date</label>
      <input type="date" name="end_date"
             value="{{ $end->toDateString() }}"
             class="w-full border rounded p-2">
    </div>
    <div class="md:col-span-2">
      <label class="block text-sm font-medium">Search (Category or Notes)</label>
      <input type="text" name="search"
             placeholder="Keyword..." 
             value="{{ $search }}"
             class="w-full border rounded p-2">
    </div>
    <div class="md:col-span-4 text-right">
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
        Filter
      </button>
      <a href="{{ route('personal.expenses.index') }}"
         class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded">
        Clear
      </a>
    </div>
  </form>

  <!-- Table -->
  <div class="overflow-x-auto bg-white shadow rounded">
    <table class="min-w-full">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="py-2 px-4">Date</th>
          <th class="py-2 px-4">Category</th>
          <th class="py-2 px-4">Amount</th>
          <th class="py-2 px-4">Notes</th>
        </tr>
      </thead>
      <tbody>
        @forelse($expenses as $e)
        <tr class="border-b">
          <td class="py-2 px-4">{{ $e->date }}</td>
          <td class="py-2 px-4">{{ $e->category }}</td>
          <td class="py-2 px-4">{{ number_format($e->amount,2) }}</td>
          <td class="py-2 px-4">{{ $e->notes }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="p-4 text-center">No expenses found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="mt-4">
    {{ $expenses->links() }}
  </div>
</div>
@endsection
