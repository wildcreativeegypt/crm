@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Ads</h1>
    <a href="{{ route('ads.create') }}" class="btn btn-primary mb-3">Log New Ad</a>
    <div class="overflow-x-auto">
        @if ($ads->isEmpty())
            <div class="alert alert-info">
                No ads have been logged yet. <a href="{{ route('ads.create') }}" class="font-bold text-blue-500">Log the first ad!</a>
            </div>
        @else
            <table class="table w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">Client</th>
                        <th class="border border-gray-300 px-4 py-2">Facebook Account</th>
                        <th class="border border-gray-300 px-4 py-2">Page Name</th>
                        <th class="border border-gray-300 px-4 py-2">Cost</th> <!-- Updated from Spend Amount -->
                        <th class="border border-gray-300 px-4 py-2">Tax</th> <!-- Updated from Tax Rate -->
                        <th class="border border-gray-300 px-4 py-2">Total Cost</th>
                        <th class="border border-gray-300 px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ads as $ad)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $ad->client->name ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $ad->facebookAccount->name ?? 'Not Linked' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $ad->page_name }}</td>
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($ad->cost, 2) }}</td> <!-- Updated -->
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($ad->tax, 2) }}</td> <!-- Updated -->
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($ad->total_cost, 2) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $ad->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection