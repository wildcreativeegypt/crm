@extends('layouts.dashboard')

@section('title', 'Create Installment Plan')

@section('content')
<div class="container mx-auto p-6 bg-base-200">
    <h1 class="text-2xl font-bold text-base-content">Create Installment Plan</h1>
    
    <form method="POST" action="{{ route('installments.store') }}" class="mt-6 space-y-4">
        @csrf

        {{-- Name --}}
        <div class="form-control">
            <label for="name" class="label">
                <span class="label-text">Plan Name</span>
            </label>
            <input type="text" id="name" name="name" class="input input-bordered w-full" value="{{ old('name') }}" required>
        </div>

        {{-- Total Amount --}}
        <div class="form-control">
            <label for="total_amount" class="label">
                <span class="label-text">Total Amount</span>
            </label>
            <input type="number" id="total_amount" name="total_amount" class="input input-bordered w-full" value="{{ old('total_amount') }}" required>
        </div>

        {{-- Monthly Installment --}}
        <div class="form-control">
            <label for="monthly_installment" class="label">
                <span class="label-text">Monthly Installment</span>
            </label>
            <input type="number" id="monthly_installment" name="monthly_installment" class="input input-bordered w-full" value="{{ old('monthly_installment') }}" required>
        </div>

        {{-- Duration (in months) --}}
        <div class="form-control">
            <label for="duration_months" class="label">
                <span class="label-text">Duration (Months)</span>
            </label>
            <input type="number" id="duration_months" name="duration_months" class="input input-bordered w-full" value="{{ old('duration_months') }}" required>
        </div>

        {{-- Start Date --}}
        <div class="form-control">
            <label for="start_date" class="label">
                <span class="label-text">Start Date</span>
            </label>
            <input type="date" id="start_date" name="start_date" class="input input-bordered w-full" value="{{ old('start_date') }}" required>
        </div>

        {{-- Submit Button --}}
        <div class="form-control">
            <button type="submit" class="btn btn-primary">Create Plan</button>
        </div>
    </form>
</div>
@endsection