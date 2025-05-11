@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  <h1 class="text-2xl font-bold mb-4">Record a New Top-Up</h1>

  <form action="{{ route('ad_account_topups.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label for="ad_account_id" class="block font-medium">Ad Account</label>
      <select id="ad_account_id"
              name="ad_account_id"
              class="w-full border rounded p-2 @error('ad_account_id') border-red-500 @enderror">
        <option value="">-- Select Account --</option>
        @foreach($accounts as $acct)
          <option value="{{ $acct->id }}"
            {{ old('ad_account_id') == $acct->id ? 'selected' : '' }}>
            {{ $acct->name }}
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
             class="w-full border rounded p-2 @error('date') border-red-500 @enderror" />
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
             class="w-full border rounded p-2 @error('amount') border-red-500 @enderror" />
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
      Save Top-Up
    </button>
  </form>
</div>
@endsection
