{{-- resources/views/payments/index.blade.php --}}
@extends('layouts.dashboard')

@section('title','Payments Received')

@section('content')
<div class="p-6 space-y-6">
  <h1 class="text-2xl font-bold">Payments Received</h1>
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
      <input type="text" name="search" placeholder="Invoice or Method…" value="{{ request('search') }}" class="input input-bordered" />
    </div>
    <div class="md:col-span-4 text-right space-x-2">
      <button class="btn btn-primary">Apply Filters</button>
      <a href="{{ route('payments.index') }}" class="btn btn-outline">Clear</a>
    </div>
  </form>

  <div class="overflow-x-auto bg-base-100 shadow rounded">
    <table class="table table-zebra w-full">
      <thead>
        <tr>
          <th>Date</th><th>Invoice</th><th>Gross</th><th>Tax Rate</th><th>Tax</th><th>Net</th><th>Method</th>
        </tr>
      </thead>
      <tbody>
        @forelse($payments as $p)
          <tr>
            <td>{{ $p->date }}</td>
            <td>{{ $p->invoice_id }}</td>
            <td>{{ number_format($p->amount,2) }}</td>
            <td>{{ ($p->company_tax_rate*100) }}%</td>
            <td>{{ number_format($p->company_tax_amount,2) }}</td>
            <td>{{ number_format($p->net_received,2) }}</td>
            <td>{{ $p->method }}</td>
          </tr>
        @empty
          <tr><td colspan="7" class="text-center">No payments.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $payments->links() }}</div>
</div>
@endsection
