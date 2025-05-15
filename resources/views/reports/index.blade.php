@extends('layouts.dashboard')

@section('title', 'Reports & Analytics')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Installment Reports & Analytics</h1>

    {{-- Dropdown for Plan Selection --}}
    <form method="GET" action="{{ route('reports.index') }}" class="flex flex-col md:flex-row md:items-end gap-4 mb-6">
        <div class="form-control w-full max-w-xs">
            <label for="plan_id" class="label">
                <span class="label-text font-semibold">Select Installment Plan:</span>
            </label>
            <select id="plan_id" name="plan_id" class="select select-bordered w-full">
                <option value="">All Plans</option>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}" {{ $data['selectedPlan'] && $data['selectedPlan']->id == $plan->id ? 'selected' : '' }}>
                        {{ $plan->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary md:mb-0">Filter</button>
    </form>

    {{-- Metrics Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="card bg-base-100 shadow-md p-4">
            <h2 class="text-lg font-semibold">Total Revenue</h2>
            <p class="text-2xl font-bold text-green-600">{{ number_format($data['totalRevenue'], 2) }} EGP</p>
        </div>
        <div class="card bg-base-100 shadow-md p-4">
            <h2 class="text-lg font-semibold">Outstanding Balances</h2>
            <p class="text-2xl font-bold text-red-600">{{ number_format($data['outstandingBalances'], 2) }} EGP</p>
        </div>
        <div class="card bg-base-100 shadow-md p-4">
            <h2 class="text-lg font-semibold">Completed Installments</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $data['completedCount'] }}</p>
        </div>
        <div class="card bg-base-100 shadow-md p-4">
            <h2 class="text-lg font-semibold">Ongoing Installments</h2>
            <p class="text-2xl font-bold text-yellow-600">{{ $data['ongoingCount'] }}</p>
        </div>
        <div class="card bg-base-100 shadow-md p-4">
            <h2 class="text-lg font-semibold">Total Penalties</h2>
            <p class="text-2xl font-bold text-orange-600">{{ number_format($data['totalPenalties'], 2) }} EGP</p>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="bg-base-100 shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Installment Status Breakdown</h2>
        <div class="relative w-full max-w-md mx-auto">
            <canvas id="statusChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>

{{-- Chart.js Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Completed', 'Ongoing'],
            datasets: [{
                data: [{{ $data['completedCount'] }}, {{ $data['ongoingCount'] }}],
                backgroundColor: ['#4CAF50', '#FFC107'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
        }
    });
</script>
@endsection