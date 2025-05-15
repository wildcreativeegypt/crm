@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Log New Ad</h1>
    <div class="card shadow">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-error mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('ads.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="client_id" class="block text-sm font-medium">Client</label>
                    <select name="client_id" id="client_id" class="select select-bordered w-full" required>
                        <option value="">Select a Client</option>
                        @foreach ($clients as $client)
                            @if ($client->facebookAccount)
                                <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->facebookAccount->name }})</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="page_name" class="block text-sm font-medium">Page Name</label>
                    <input type="text" name="page_name" id="page_name" class="input input-bordered w-full" value="{{ old('page_name') }}" required>
                </div>
                <div class="mb-4">
    <label for="spend_amount" class="block text-sm font-medium">Spend Amount</label>
    <input type="number" name="spend_amount" id="spend_amount" class="input input-bordered w-full" step="0.01" value="{{ old('spend_amount') }}" required>
</div>
                <div class="mb-4">
                    <label for="date_from" class="block text-sm font-medium">Start Date</label>
                    <input type="date" name="date_from" id="date_from" class="input input-bordered w-full" value="{{ old('date_from') }}" required>
                </div>
                <div class="mb-4">
                    <label for="date_to" class="block text-sm font-medium">End Date</label>
                    <input type="date" name="date_to" id="date_to" class="input input-bordered w-full" value="{{ old('date_to') }}" required>
                </div>
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary">Log Ad</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection