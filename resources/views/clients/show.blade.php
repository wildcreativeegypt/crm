@extends('layouts.dashboard')


@section('title', $client->name)

@section('content')
<div class="container mx-auto p-4 space-y-6">

  <!-- Header & Date Filter -->
  <div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">{{ $client->name }}</h1>
    <form method="GET" class="flex space-x-2 items-end">
      <div>
        <label class="block text-sm">Start Date</label>
        <input type="date" name="start_date"
               value="{{ $start->toDateString() }}"
               class="border rounded p-1">
      </div>
      <div>
        <label class="block text-sm">End Date</label>
        <input type="date" name="end_date"
               value="{{ $end->toDateString() }}"
               class="border rounded p-1">
      </div>
      <button type="submit"
              class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
        Filter
      </button>
    </form>
  </div>

  <!-- KPI Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="bg-white shadow rounded p-4 text-center">
      <h2 class="text-sm font-semibold">Installments Due</h2>
      <p class="text-2xl">{{ number_format($installmentsDue,2) }} EGP</p>
    </div>
    <div class="bg-white shadow rounded p-4 text-center">
      <h2 class="text-sm font-semibold">Total Funded</h2>
      <p class="text-2xl">{{ number_format($funded,2) }} EGP</p>
    </div>
    <div class="bg-white shadow rounded p-4 text-center">
      <h2 class="text-sm font-semibold">My Spending</h2>
      <p class="text-2xl">{{ number_format($spending,2) }} EGP</p>
    </div>
  </div>

  <!-- Ad Expenses Table -->
  <div class="mt-8">
    <h2 class="text-xl font-semibold mb-2">
      Ad Expenses ({{ $start->toDateString() }} → {{ $end->toDateString() }})
    </h2>
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
          @forelse($adExpenses as $exp)
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
            <td colspan="6" class="p-4 text-center text-gray-500">
              No ad expenses in this period.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Payments Table -->
  <div class="mt-8">
    <h2 class="text-xl font-semibold mb-2">
      Payments Received ({{ $start->toDateString() }} → {{ $end->toDateString() }})
    </h2>
    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="min-w-full">
        <thead class="bg-gray-200 text-gray-700">
          <tr>
            <th class="py-2 px-4">Date</th>
            <th class="py-2 px-4">Invoice ID</th>
            <th class="py-2 px-4">Gross</th>
            <th class="py-2 px-4">Tax</th>
            <th class="py-2 px-4">Net</th>
            <th class="py-2 px-4">Method</th>
          </tr>
        </thead>
        <tbody>
          @forelse($payments as $pmt)
          <tr class="border-b">
            <td class="py-2 px-4">{{ $pmt->date }}</td>
            <td class="py-2 px-4">{{ $pmt->invoice_id }}</td>
            <td class="py-2 px-4">{{ number_format($pmt->amount,2) }}</td>
            <td class="py-2 px-4">{{ number_format($pmt->company_tax_amount,2) }}</td>
            <td class="py-2 px-4">{{ number_format($pmt->net_received,2) }}</td>
            <td class="py-2 px-4">{{ $pmt->method }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">
              No payments in this period.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
