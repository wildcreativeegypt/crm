@extends('layouts.dashboard')

@section('title', 'Installments')

@section('content')
<div class="container mx-auto p-6 bg-base-200">
    <h1 class="text-2xl font-bold text-base-content">Installment Plans</h1>
    <a href="{{ route('installments.create') }}" class="btn btn-primary mt-4">Create New Plan</a>

    {{-- Table of Installment Plans --}}
    <div class="overflow-x-auto mt-6">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Total Amount</th>
                    <th>Remaining Balance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{ $plan->name }}</td>
                        <td>${{ number_format($plan->total_amount, 2) }}</td>
                        <td>${{ number_format($plan->remaining_balance, 2) }}</td>
                        <td>
                            <a href="{{ route('installments.show', $plan) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection