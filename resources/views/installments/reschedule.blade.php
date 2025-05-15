@extends('layouts.dashboard')

@section('title', 'Reschedule Installment Plan')

@section('content')
<div class="container mx-auto p-6 bg-base-200">
    <h1 class="text-2xl font-bold text-base-content">Reschedule Installment Plan</h1>
    
    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Reschedule form --}}
    <form method="POST" action="{{ route('installments.reschedule', $plan) }}" class="space-y-4">
    @csrf

    {{-- Rescheduled Date Input --}}
    <div class="form-control">
        <label for="rescheduled_date" class="label">
            <span class="label-text">New Start Date</span>
        </label>
        <input type="date" id="rescheduled_date" name="rescheduled_date" 
               class="input input-bordered w-full" 
               value="{{ old('rescheduled_date') ?? $plan->start_date }}" 
               min="{{ $plan->start_date }}" required>
    </div>

    {{-- Submit Button --}}
    <div class="form-control">
        <button type="submit" class="btn btn-primary">Reschedule</button>
    </div>
</form>
</div>
@endsection