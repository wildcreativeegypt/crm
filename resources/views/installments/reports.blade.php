@extends('layouts.dashboard')

@section('title', 'Installment Reports & Analytics')

@section('content')
<div class="container mx-auto p-6 bg-base-200">
    <h1 class="text-2xl font-bold text-base-content">Installment Reports & Analytics</h1>

    <div class="overflow-x-auto mt-6">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>Plan Name</th>
                    <th>Total Amount</th>
                    <th>Amount Paid</th>
                    <th>Remaining Balance</th>
                    <th>Total Penalties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData as $data)
                    <tr>
                        <td>{{ $data['name'] }}</td>
                        <td>${{ number_format($data['total_amount'], 2) }}</td>
                        <td>${{ number_format($data['amount_paid'], 2) }}</td>
                        <td>${{ number_format($data['remaining_balance'], 2) }}</td>
                        <td>${{ number_format($data['total_penalties'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection