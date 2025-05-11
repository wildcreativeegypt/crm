@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  <h1 class="text-2xl font-bold mb-4">Add an Expense</h1>

  <form action="{{ route('personal.expenses.store') }}" method="POST">
    @csrf

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
      <label for="category" class="block font-medium">Category</label>
      <input type="text"
             id="category"
             name="category"
             value="{{ old('category') }}"
             class="w-full border rounded p-2 @error('category') border-red-500 @enderror"
             placeholder="e.g. Meals, Transport">
      @error('category')
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
             class="w-full border rounded p-2 @error('amount') border-red-500 @enderror">
      @error('amount')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="notes" class="block font-medium">Notes (optional)</label>
      <textarea id="notes"
                name="notes"
                rows="3"
                class="w-full border rounded p-2">{{ old('notes') }}</textarea>
    </div>

    <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
      Save Expense
    </button>
  </form>
</div>
@endsection
