@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  <h1 class="text-2xl font-bold mb-4">Record a Payment</h1>

  <form action="{{ route('payments.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label for="invoice_id" class="block font-medium">Invoice ID</label>
      <input type="number"
             id="invoice_id"
             name="invoice_id"
             value="{{ old('invoice_id') }}"
             class="w-full border rounded p-2 @error('invoice_id') border-red-500 @enderror">
      @error('invoice_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="date" class="block font-medium">Date</label>
      <input type="date"
             id="date"
             name="date"
             value="{{ old('date', now()->toDateString()) }}"
             class="w-full border rounded p-2 @error('date') border-red-500 @enderror">
      @error('date')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="amount" class="block font-medium">Gross Amount (EGP)</label>
      <input type="number"
             step="0.01"
             id="amount"
             name="amount"
             value="{{ old('amount') }}"
             class="w-full border rounded p-2 @error('amount') border-red-500 @enderror">
      @error('amount')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="company_tax_rate" class="block font-medium">Company Tax Rate (%)</label>
      <input type="number"
             step="0.01"
             id="company_tax_rate"
             name="company_tax_rate"
             value="{{ old('company_tax_rate', 0) }}"
             class="w-full border rounded p-2 @error('company_tax_rate') border-red-500 @enderror">
      @error('company_tax_rate')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
      <p class="mt-1">Tax Amount: <span id="tax-display">0.00</span> EGP</p>
    </div>

    <div class="mb-4">
      <label for="method" class="block font-medium">Method</label>
      <input type="text"
             id="method"
             name="method"
             placeholder="e.g. Bank Transfer"
             value="{{ old('method') }}"
             class="w-full border rounded p-2 @error('method') border-red-500 @enderror">
      @error('method')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Save Payment
    </button>
  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const amtInput = document.getElementById('amount');
  const rateInput = document.getElementById('company_tax_rate');
  const display   = document.getElementById('tax-display');

  function updateTax() {
    const amt  = parseFloat(amtInput.value) || 0;
    const rate = (parseFloat(rateInput.value) || 0) / 100;
    display.textContent = (amt * rate).toFixed(2);
  }

  amtInput.addEventListener('input', updateTax);
  rateInput.addEventListener('input', updateTax);
  updateTax();
});
</script>
@endsection
