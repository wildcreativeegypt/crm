@extends('layouts.dashboard')

@section('title', 'Clients')

@section('content')
<div class="container mx-auto p-4 space-y-4">

  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Clients</h1>
    <a href="{{ route('clients.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      + New Client
    </a>
  </div>

  <!-- Search Form -->
  <form method="GET" class="flex space-x-2 mb-4">
    <input type="text"
           name="search"
           value="{{ $search ?? '' }}"
           placeholder="Search clients..."
           class="flex-1 border rounded p-2"
    />
    <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
      Search
    </button>
    <a href="{{ route('clients.index') }}"
       class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
      Clear
    </a>
  </form>

  <!-- Clients List -->
  <ul class="bg-white shadow rounded divide-y">
    @forelse($clients as $client)
      <li class="p-4">
        <a href="{{ route('clients.show', $client) }}"
           class="text-gray-800 hover:underline">
          {{ $client->name }}
        </a>
      </li>
    @empty
      <li class="p-4 text-gray-500 text-center">No clients found.</li>
    @endforelse
  </ul>

  <!-- Pagination -->
  <div class="mt-4">
    {{ $clients->links() }}
  </div>

</div>
@endsection
