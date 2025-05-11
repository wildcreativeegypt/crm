@extends('layouts.dashboard')

@section('title', 'CRM Dashboard')

@section('content')
<div class="container mx-auto p-4 space-y-6">

  <h1 class="text-3xl font-bold">CRM Dashboard</h1>

  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
    <div class="p-4 bg-white shadow rounded text-center">
      <h2 class="text-sm font-semibold">Clients</h2>
      <p class="text-2xl">{{ $clientCount }}</p>
    </div>
    <div class="p-4 bg-white shadow rounded text-center">
      <h2 class="text-sm font-semibold">Ad Balance (EGP)</h2>
      <p class="text-2xl">{{ number_format($totalAdBalance,2) }}</p>
    </div>
    <div class="p-4 bg-white shadow rounded text-center">
      <h2 class="text-sm font-semibold">Ad Spend (EGP)</h2>
      <p class="text-2xl">{{ number_format($totalAdExpenses,2) }}</p>
    </div>
    <div class="p-4 bg-white shadow rounded text-center">
      <h2 class="text-sm font-semibold">Payments (EGP)</h2>
      <p class="text-2xl">{{ number_format($totalPayments,2) }}</p>
    </div>
    <div class="p-4 bg-white shadow rounded text-center">
      <h2 class="text-sm font-semibold">Personal Exp (EGP)</h2>
      <p class="text-2xl">{{ number_format($totalPersonalExpenses,2) }}</p>
    </div>
    <div class="p-4 bg-white shadow rounded text-center">
      <h2 class="text-sm font-semibold">Open Installs</h2>
      <p class="text-2xl">{{ $upcomingInstallments }}</p>
    </div>
  </div>

</div>
@endsection
