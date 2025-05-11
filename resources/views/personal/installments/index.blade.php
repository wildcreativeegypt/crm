@extends('layouts.dashboard')


@section('content')
<div class="container mx-auto p-4 space-y-4">

  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">My Installments</h1>
    <a href="{{ route('personal.installments.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      + New Installment
    </a>
  </div>

  <!-- Filter Form -->
  <form method="GET" class="bg-white p-4 shadow rounded grid grid-cols-1 md:grid-cols-4 gap-4">
    <div>
      <label class="block text-sm font-medium">Start Due</label>
      <input type="date" name="start_date" value="{{ $start }}"
             class="w-full border rounded p-2">
    </div>
    <div>
      <label class="block text-sm font-medium">End Due</label>
      <input type="date" name="end_date" value="{{ $end }}"
             class="w-full border rounded p-2">
    </div>
    <div class="md:col-span-2">
      <label class="block text-sm font-medium">Search Payee</label>
      <input type="text" name="search" placeholder="Keyword..." value="{{ $search }}"
             class="w-full border rounded p-2">
    </div>
    <div class="md:col-span-4 text-right">
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
      <a href="{{ route('personal.installments.index') }}"
         class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded">Clear</a>
    </div>
  </form>

  <!-- Table -->
  <div class="overflow-x-auto bg-white shadow rounded">
    <table class="min-w-full">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="py-2 px-4">Payee</th>
          <th class="py-2 px-4">Amount</th>
          <th class="py-2 px-4">Due Date</th>
          <th class="py-2 px-4">Frequency</th>
          <th class="py-2 px-4">Paid?</th>
        </tr>
      </thead>
      <tbody>
        @forelse($installments as $ins)
        <tr class="border-b">
          <td class="py-2 px-4">{{ $ins->payee }}</td>
          <td class="py-2 px-4">{{ number_format($ins->installment_amount,2) }}</td>
          <td class="py-2 px-4">{{ $ins->due_date }}</td>
          <td class="py-2 px-4">{{ ucfirst($ins->frequency) }}</td>
          <td class="py-2 px-4">{{ $ins->paid ? 'Yes':'No' }}</td>
        </tr>
        @empty
        <tr><td colspan="5" class="p-4 text-center">No installments found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div>{{ $installments->links() }}</div>
</div>
@endsection
