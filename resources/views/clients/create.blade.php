@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  <h1 class="text-2xl font-bold mb-4">Add Client</h1>

  <form action="{{ route('clients.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label for="name" class="block font-medium">Client Name</label>
      <input type="text"
             id="name"
             name="name"
             value="{{ old('name') }}"
             class="w-full border rounded p-2 @error('name') border-red-500 @enderror"
             placeholder="Enter client name">
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Save Client
    </button>
  </form>
</div>
@endsection
