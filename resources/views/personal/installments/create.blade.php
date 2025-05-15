@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  <h1 class="text-2xl font-bold mb-4">Schedule a Personal Installment</h1>

  <form action="{{ route('personal.installments.store') }}" method="POST" class="space-y-4">
    @csrf

    <div class="form-control">
      <label for="payee" class="label">
        <span class="label-text font-semibold">Payee</span>
      </label>
      <input type="text"
             id="payee"
             name="payee"
             value="{{ old('payee') }}"
             class="input input-bordered w-full @error('payee') input-error @enderror"
             placeholder="e.g. Bank Loan">
      @error('payee')
        <span class="text-error text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-control">
      <label for="installment_amount" class="label">
        <span class="label-text font-semibold">Amount (EGP)</span>
      </label>
      <input type="number"
             step="0.01"
             id="installment_amount"
             name="installment_amount"
             value="{{ old('installment_amount') }}"
             class="input input-bordered w-full @error('installment_amount') input-error @enderror">
      @error('installment_amount')
        <span class="text-error text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-control">
      <label for="due_date" class="label">
        <span class="label-text font-semibold">Due Date</span>
      </label>
      <input type="date"
             id="due_date"
             name="due_date"
             value="{{ old('due_date', now()->toDateString()) }}"
             class="input input-bordered w-full @error('due_date') input-error @enderror">
      @error('due_date')
        <span class="text-error text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-control">
      <label for="frequency" class="label">
        <span class="label-text font-semibold">Frequency</span>
      </label>
      <select id="frequency"
              name="frequency"
              class="select select-bordered w-full @error('frequency') select-error @enderror">
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
        <option value="quarterly">Quarterly</option>
        <option value="custom">Custom</option>
      </select>
      @error('frequency')
        <span class="text-error text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-control">
      <label for="is_recurring" class="cursor-pointer flex items-center space-x-2">
        <input type="checkbox" id="is_recurring" name="is_recurring" class="checkbox" {{ old('is_recurring') ? 'checked' : '' }}>
        <span class="label-text font-semibold">Is Recurring?</span>
      </label>
    </div>

    <div class="form-control" id="recurring-fields" style="display: none;">
      <label for="recurring_interval" class="label">
        <span class="label-text font-semibold">Recurring Interval</span>
      </label>
      <select id="recurring_interval" name="recurring_interval" class="select select-bordered w-full">
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
        <option value="custom">Custom</option>
      </select>

      <label for="recurring_end_date" class="label mt-4">
        <span class="label-text font-semibold">End Date</span>
      </label>
      <input type="date" id="recurring_end_date" name="recurring_end_date" class="input input-bordered w-full">
    </div>

    <script>
      document.getElementById('is_recurring').addEventListener('change', function () {
          document.getElementById('recurring-fields').style.display = this.checked ? 'block' : 'none';
      });
    </script>

    <button type="submit" class="btn btn-primary w-full">Save Installment</button>
  </form>
</div>
@endsection