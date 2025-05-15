{{-- resources/views/ad_account_topups/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'New Top-Up')

@section('content')
<div class="container mx-auto p-6 max-w-lg">
  <h1 class="text-2xl font-bold mb-6">Record a New Top-Up</h1>

  <form action="{{ route('ad_account_topups.store') }}" method="POST" class="space-y-6">
    @csrf

    {{-- Ad Account --}}
    <div class="form-control w-full">
      <label for="ad_account_id" class="label">
        <span class="label-text">Ad Account</span>
      </label>
      <select
        id="ad_account_id"
        name="ad_account_id"
        class="select select-bordered w-full @error('ad_account_id') select-error @enderror"
      >
        <option value="">-- Select Account --</option>
        @foreach($accounts as $acct)
          <option value="{{ $acct->id }}"
            {{ old('ad_account_id') == $acct->id ? 'selected' : '' }}>
            {{ $acct->name }}
          </option>
        @endforeach
      </select>
      @error('ad_account_id')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Date --}}
    <div class="form-control w-full">
      <label for="date" class="label">
        <span class="label-text">Date</span>
      </label>
      <input
        type="date"
        id="date"
        name="date"
        value="{{ old('date', now()->toDateString()) }}"
        class="input input-bordered w-full @error('date') input-error @enderror"
      />
      @error('date')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Amount --}}
    <div class="form-control w-full">
      <label for="amount" class="label">
        <span class="label-text">Amount (EGP)</span>
      </label>
      <input
        type="number"
        step="0.01"
        id="amount"
        name="amount"
        placeholder="e.g. 1500.00"
        value="{{ old('amount') }}"
        class="input input-bordered w-full @error('amount') input-error @enderror"
      />
      @error('amount')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Notes --}}
    <div class="form-control w-full">
      <label for="notes" class="label">
        <span class="label-text">Notes (optional)</span>
      </label>
      <textarea
        id="notes"
        name="notes"
        rows="4"
        class="textarea textarea-bordered w-full"
        placeholder="Any extra info…"
      >{{ old('notes') }}</textarea>
    </div>

    {{-- Submit --}}
    <div class="form-control">
      <button type="submit" class="btn btn-success">
        Save Top-Up
      </button>
    </div>
  </form>
</div>
@endsection
