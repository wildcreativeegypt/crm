@extends('layouts.dashboard')

@section('title', 'Installment Details')

@section('content')
<div class="container mx-auto p-6 bg-base-200">
    <h1 class="text-2xl font-bold text-base-content">{{ $plan->name }}</h1>
    <p class="mt-2 text-base-content">Total Amount: ${{ number_format($plan->total_amount, 2) }}</p>
    <p class="mt-2 text-base-content">Remaining Balance: ${{ number_format($plan->remaining_balance, 2) }}</p>
    <p class="mt-2 text-base-content">Monthly Installment: ${{ number_format($plan->monthly_installment, 2) }}</p>
    <p class="mt-2 text-base-content">Duration: {{ $plan->duration_months }} months</p>
    <p class="mt-2 text-base-content">Start Date: {{ $plan->start_date->format('Y-m-d') }}</p>
    
    <div class="actions mt-4">
        <!-- Reschedule Button -->
        <a href="{{ route('installments.reschedule.form', $plan) }}" class="btn btn-warning">Reschedule</a>

        <!-- Delete Installment Plan Button -->
        <form method="POST" action="{{ route('installments.delete', $plan) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this installment plan? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error">Delete Installment Plan</button>
        </form>
    </div>

    {{-- Payment History Table --}}
    <div class="overflow-x-auto mt-6">
        <h2 class="text-xl font-bold text-base-content">Payment History</h2>
        <table class="table table-zebra w-full mt-4">
            <thead>
                <tr>
                    <th>Payment Date</th>
                    <th>Amount</th>
                    <th>Penalty</th> {{-- New column for penalty amount --}}
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plan->payments as $payment)
                    <tr>
                        <td>{{ $payment->payment_date }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>${{ number_format($payment->penalty_amount ?? 0, 2) }}</td> {{-- Display penalty amount or 0 --}}
                        <td>{{ $payment->status }}</td>
                        <td>
                            {{-- Remove Payment Button --}}
                            <form method="POST" action="{{ route('installments.payments.remove', [$plan, $payment]) }}" onsubmit="return confirm('Are you sure you want to remove this payment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Add Payment Form --}}
    <div class="mt-6">
        <h2 class="text-xl font-bold text-base-content">Add Payment</h2>
        <form method="POST" action="{{ route('installments.pay', $plan) }}" class="mt-4 space-y-4">
            @csrf

            {{-- Payment Amount --}}
            <div class="form-control">
                <label for="amount" class="label">
                    <span class="label-text">Payment Amount</span>
                </label>
                <input type="number" id="amount" name="amount" class="input input-bordered w-full" required>
            </div>

            {{-- Penalty Amount --}}
            <div class="form-control">
                <label for="penalty_amount" class="label">
                    <span class="label-text">Penalty Amount (Optional)</span>
                </label>
                <input type="number" id="penalty_amount" name="penalty_amount" class="input input-bordered w-full" step="0.01" placeholder="Enter penalty amount if applicable">
            </div>

            {{-- Payment Date --}}
            <div class="form-control">
                <label for="payment_date" class="label">
                    <span class="label-text">Payment Date</span>
                </label>
                <input type="date" id="payment_date" name="payment_date" class="input input-bordered w-full" required>
            </div>

            {{-- Submit Button --}}
            <div class="form-control">
                <button type="submit" class="btn btn-primary">Record Payment</button>
            </div>
        </form>
    </div>
</div>
@endsection