@extends('layouts.dashboard')


@section('content')
<div class="container mx-auto p-4 space-y-4">

  <h1 class="text-2xl font-bold">Payments Received</h1>

  <!-- Filter Form -->
  <form method="GET" class="bg-white p-4 shadow rounded grid grid-cols-1 md:grid-cols-4 gap-4">
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

    <div class="md:col-span-2">
      <label class="block text-sm font-medium">Search (Invoice or Method)</label>
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
      <a href="{{ route('payments.index') }}"
         class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
        Clear
      </a>
    </div>
  </form>

  <!-- Payments Table -->
  <div class="overflow-x-auto bg-white shadow rounded">
    <table class="min-w-full">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="py-2 px-4">Date</th>
          <th class="py-2 px-4">Invoice ID</th>
          <th class="py-2 px-4">Gross</th>
          <th class="py-2 px-4">Tax Rate</th>
          <th class="py-2 px-4">Tax</th>
          <th class="py-2 px-4">Net</th>
          <th class="py-2 px-4">Method</th>
        </tr>
      </thead>
      <tbody>
        @forelse($payments as $p)
        <tr class="border-b">
          <td class="py-2 px-4">{{ $p->date }}</td>
          <td class="py-2 px-4">{{ $p->invoice_id }}</td>
          <td class="py-2 px-4">{{ number_format($p->amount,2) }}</td>
          <td class="py-2 px-4">{{ ($p->company_tax_rate*100) }}%</td>
          <td class="py-2 px-4">{{ number_format($p->company_tax_amount,2) }}</td>
          <td class="py-2 px-4">{{ number_format($p->net_received,2) }}</td>
          <td class="py-2 px-4">{{ $p->method }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="p-4 text-center text-gray-500">No payments found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="mt-4">
    {{ $payments->links() }}
  </div>

</div>
@endsection
