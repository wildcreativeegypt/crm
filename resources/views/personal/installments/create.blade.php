@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  <h1 class="text-2xl font-bold mb-4">Schedule an Installment</h1>

  <form action="{{ route('personal.installments.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label for="payee" class="block font-medium">Payee</label>
      <input type="text"
             id="payee"
             name="payee"
             value="{{ old('payee') }}"
             class="w-full border rounded p-2 @error('payee') border-red-500 @enderror"
             placeholder="e.g. Bank Loan">
      @error('payee')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="installment_amount" class="block font-medium">Amount (EGP)</label>
      <input type="number"
             step="0.01"
             id="installment_amount"
             name="installment_amount"
             value="{{ old('installment_amount') }}"
             class="w-full border rounded p-2 @error('installment_amount') border-red-500 @enderror">
      @error('installment_amount')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="due_date" class="block font-medium">Due Date</label>
      <input type="date"
             id="due_date"
             name="due_date"
             value="{{ old('due_date', now()->toDateString()) }}"
             class="w-full border rounded p-2 @error('due_date') border-red-500 @enderror">
      @error('due_date')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="frequency" class="block font-medium">Frequency</label>
      <select id="frequency"
              name="frequency"
              class="w-full border rounded p-2 @error('frequency') border-red-500 @enderror">
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
        <option value="quarterly">Quarterly</option>
        <option value="custom">Custom</option>
      </select>
      @error('frequency')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4 form-check">
      <input type="checkbox"
             id="paid"
             name="paid"
             class="form-checkbox"
             {{ old('paid') ? 'checked' : '' }}>
      <label for="paid" class="ml-2">Already Paid?</label>
    </div>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Save Installment
    </button>
  </form>
</div>
@endsection
