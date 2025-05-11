@extends('layouts.dashboard')

@section('title', 'New Ad Account')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  <h1 class="text-2xl font-bold mb-4">Add New Ad Account</h1>

  <form action="{{ route('ad_accounts.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label for="name" class="block font-medium">Account Name</label>
      <input type="text"
             id="name"
             name="name"
             value="{{ old('name') }}"
             class="w-full border rounded p-2 @error('name') border-red-500 @enderror"
             placeholder="e.g. Facebook Master">
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="currency" class="block font-medium">Currency (3-letter code)</label>
      <input type="text"
             id="currency"
             name="currency"
             value="{{ old('currency', 'EGP') }}"
             class="w-full border rounded p-2 @error('currency') border-red-500 @enderror"
             placeholder="e.g. EGP">
      @error('currency')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Create Account
    </button>
    <a href="{{ route('ad_accounts.index') }}"
       class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
      Cancel
    </a>
  </form>
</div>
@endsection
