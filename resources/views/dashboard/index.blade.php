{{-- resources/views/dashboard/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'CRM Dashboard')

@section('content')
<div class="container mx-auto p-6">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
    <div class="card bg-base-100 shadow p-4 text-center">
      <h2 class="card-title">Clients</h2>
      <p class="text-2xl">{{ $clientCount }}</p>
    </div>
    <div class="card bg-base-100 shadow p-4 text-center">
      <h2 class="card-title">Ad Balance (EGP)</h2>
      <p class="text-2xl">{{ number_format($totalAdBalance,2) }}</p>
    </div>
    <div class="card bg-base-100 shadow p-4 text-center">
      <h2 class="card-title">Ad Spend (EGP)</h2>
      <p class="text-2xl">{{ number_format($totalAdExpenses,2) }}</p>
    </div>
    <div class="card bg-base-100 shadow p-4 text-center">
      <h2 class="card-title">Payments (EGP)</h2>
      <p class="text-2xl">{{ number_format($totalPayments,2) }}</p>
    </div>
    <div class="card bg-base-100 shadow p-4 text-center">
      <h2 class="card-title">Personal Expenses</h2>
      <p class="text-2xl">{{ number_format($totalPersonalExpenses,2) }}</p>
    </div>
    <div class="card bg-base-100 shadow p-4 text-center">
      <h2 class="card-title">Open Installments</h2>
      <p class="text-2xl">{{ $upcomingInstallments }}</p>
    </div>
  </div>
</div>
@endsection
