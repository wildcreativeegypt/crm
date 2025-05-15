@extends('layouts.dashboard')

@section('content')
<div class="bg-base-200 min-h-screen py-10 px-4">

  <!-- Container -->
  <div class="container mx-auto bg-base-100 rounded-lg shadow-lg p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-base-content">My Personal Installments</h1>
      <a href="{{ route('personal.installments.create') }}" class="btn btn-primary">
        + New Installment
      </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="table w-full border border-base-300">
        <thead class="bg-base-200">
          <tr>
            <th class="py-3 px-4">Payee</th>
            <th class="py-3 px-4">Amount (EGP)</th>
            <th class="py-3 px-4">Due Date</th>
            <th class="py-3 px-4">Recurring</th>
            <th class="py-3 px-4">Paid</th>
          </tr>
        </thead>
        <tbody>
          @forelse($installments as $installment)
          <tr>
            <td class="py-3 px-4">{{ $installment->payee }}</td>
            <td class="py-3 px-4">{{ number_format($installment->installment_amount, 2) }}</td>
            <td class="py-3 px-4">{{ $installment->due_date }}</td>
            <td class="py-3 px-4">
              @if ($installment->isRecurring())
                <span class="badge badge-info">{{ ucfirst($installment->recurring_interval) }}</span>
              @else
                <span class="badge badge-ghost">No</span>
              @endif
            </td>
            <td class="py-3 px-4">
              @if ($installment->paid)
                <span class="badge badge-success">Yes</span>
              @else
                <span class="badge badge-error">No</span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center py-6 text-base-content">
              No installments found. Start by adding a <a href="{{ route('personal.installments.create') }}" class="text-primary underline">new installment</a>.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if ($installments->hasPages())
      <div class="mt-6">
        {{ $installments->links('pagination::tailwind') }}
      </div>
    @endif

  </div>
</div>
@endsection