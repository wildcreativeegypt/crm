@extends('layouts.dashboard')


@section('content')
<div class="container mx-auto p-4 space-y-4">

  <h1 class="text-2xl font-bold">Ad Expenses</h1>

  <!-- Filter Form -->
  <form method="GET" class="bg-white p-4 shadow rounded grid grid-cols-1 md:grid-cols-4 gap-4">
    <div>
      <label class="block text-sm font-medium">Account</label>
      <select name="account_id"
              class="w-full border rounded p-2">
        <option value="">All Accounts</option>
        @foreach($accounts as $acct)
          <option value="{{ $acct->id }}"
            {{ $accountId == $acct->id ? 'selected' : '' }}>
            {{ $acct->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="block text-sm font-medium">Start Date</label>
      <input type="date"
             name="start_date"
             value="{{ $start }}"
             class="w-full border rounded p-2">
    </div>

    <div>
      <label class="block text-sm font-medium">End Date</label>
      <input type="date"
             name="end_date"
             value="{{ $end }}"
             class="w-full border rounded p-2">
    </div>

    <div>
      <label class="block text-sm font-medium">Search Notes</label>
      <input type="text"
             name="search"
             placeholder="Keyword..."
             value="{{ $search }}"
             class="w-full border rounded p-2">
    </div>

    <div class="md:col-span-4 text-right">
      <button type="submit"
              class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Apply Filters
      </button>
      <a href="{{ route('ad_expenses.index') }}"
         class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
        Clear
      </a>
    </div>
  </form>

  <!-- Expenses Table -->
  <div class="overflow-x-auto bg-white shadow rounded">
    <table class="min-w-full">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="py-2 px-4">Date</th>
          <th class="py-2 px-4">Account</th>
          <th class="py-2 px-4">Amount</th>
          <th class="py-2 px-4">Fee</th>
          <th class="py-2 px-4">Total</th>
          <th class="py-2 px-4">Notes</th>
        </tr>
      </thead>
      <tbody>
        @forelse($expenses as $exp)
        <tr class="border-b">
          <td class="py-2 px-4">{{ $exp->date }}</td>
          <td class="py-2 px-4">{{ $exp->account->name }}</td>
          <td class="py-2 px-4">{{ number_format($exp->amount,2) }}</td>
          <td class="py-2 px-4">{{ number_format($exp->credit_card_fee_amount,2) }}</td>
          <td class="py-2 px-4">{{ number_format($exp->total_cost,2) }}</td>
          <td class="py-2 px-4">{{ $exp->notes }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="p-4 text-center text-gray-500">No expenses found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination Links -->
  <div class="mt-4">
    {{ $expenses->links() }}
  </div>

</div>
@endsection
