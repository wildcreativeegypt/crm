@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    {{-- Page Header --}}
    <h1 class="text-3xl font-bold mb-6">Clients</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Add New Client</a>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 mr-2" fill="none"
                 viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Clients Table --}}
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Facebook Account</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $client->facebookAccount ? 'badge-primary' : 'badge-outline' }}">
                                {{ $client->facebookAccount->name ?? 'Not Connected' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error btn-sm" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">
                            No clients found.
                            <a href="{{ route('clients.create') }}" class="link">Add one</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($clients->hasPages())
        <div class="flex justify-center mt-6">
            {{ $clients->onEachSide(1)->links('vendor.pagination.daisy') }}
        </div>
    @endif
</div>
@endsection