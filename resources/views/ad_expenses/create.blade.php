@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  <h1 class="text-2xl font-bold mb-4">Add Ad Expense</h1>

  <form action="{{ route('ad_expenses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
      <label for="ad_account_id" class="block font-medium">Ad Account</label>
      <select id="ad_account_id"
              name="ad_account_id"
              class="w-full border rounded p-2 @error('ad_account_id') border-red-500 @enderror">
        <option value="">-- Select Account --</option>
        @foreach($adAccounts as $account)
          <option value="{{ $account->id }}"
            {{ old('ad_account_id') == $account->id ? 'selected' : '' }}>
            {{ $account->name }} (Balance: {{ number_format($account->balance,2) }} EGP)
          </option>
        @endforeach
      </select>
      @error('ad_account_id')
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
      <label for="amount" class="block font-medium">Amount (EGP)</label>
      <input type="number"
             step="0.01"
             id="amount"
             name="amount"
             value="{{ old('amount') }}"
             class="w-full border rounded p-2 @error('amount') border-red-500 @enderror" required>
      @error('amount')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="credit_card_fee_rate" class="block font-medium">CC Fee Rate (%)</label>
      <input type="number"
             step="0.01"
             id="credit_card_fee_rate"
             name="credit_card_fee_rate"
             value="{{ old('credit_card_fee_rate', config('crm.credit_card_fee_rate') * 100) }}"
             class="w-full border rounded p-2 @error('credit_card_fee_rate') border-red-500 @enderror">
      @error('credit_card_fee_rate')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
      <p class="mt-1">Fee Amount: <span id="fee-display">0.00</span> EGP</p>
    </div>

    <div class="mb-4 form-check">
      <input type="checkbox"
             id="reimbursed"
             name="reimbursed"
             class="form-checkbox"
             {{ old('reimbursed') ? 'checked' : '' }}>
      <label for="reimbursed" class="ml-2">Reimbursed</label>
    </div>
    <div class="mb-4 form-check">
      <input type="checkbox"
             id="invoiced"
             name="invoiced"
             class="form-checkbox"
             {{ old('invoiced') ? 'checked' : '' }}>
      <label for="invoiced" class="ml-2">Invoiced</label>
    </div>

    <div class="mb-4">
      <label for="notes" class="block font-medium">Notes</label>
      <textarea id="notes"
                name="notes"
                rows="3"
                class="w-full border rounded p-2">{{ old('notes') }}</textarea>
    </div>

    <div class="mb-4">
      <label for="receipt" class="block font-medium">Receipt (optional)</label>
      <input type="file"
             id="receipt"
             name="receipt"
             class="w-full">
    </div>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Save Expense
    </button>
  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const amountInput = document.getElementById('amount');
  const rateInput   = document.getElementById('credit_card_fee_rate');
  const feeDisplay  = document.getElementById('fee-display');

  function updateFee() {
    const amt  = parseFloat(amountInput.value) || 0;
    const rate = (parseFloat(rateInput.value) || 0) / 100;
    feeDisplay.textContent = (amt * rate).toFixed(2);
  }

  amountInput.addEventListener('input', updateFee);
  rateInput.addEventListener('input', updateFee);

  updateFee();
});
</script>
@endsection
