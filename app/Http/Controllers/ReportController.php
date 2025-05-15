<?php

namespace App\Http\Controllers;

use App\Models\InstallmentPlan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
{
    // Get the selected plan ID from the request
    $planId = $request->query('plan_id');

    // Fetch all plans for the dropdown
    $plans = InstallmentPlan::all(['id', 'name']);

    // Fetch data for the selected plan, or show aggregated data for all plans
    if ($planId) {
        $selectedPlan = InstallmentPlan::with('payments')->find($planId);
        $totalRevenue = $selectedPlan->amount_paid;
        $outstandingBalances = $selectedPlan->remaining_balance;
        $completedCount = $selectedPlan->remaining_balance == 0 ? 1 : 0;
        $ongoingCount = $selectedPlan->remaining_balance > 0 ? 1 : 0;
        $totalPenalties = $selectedPlan->totalPenalties(); // Calculate penalties for the selected plan
    } else {
        $totalRevenue = InstallmentPlan::sum('amount_paid');
        $outstandingBalances = InstallmentPlan::sum('remaining_balance');
        $completedCount = InstallmentPlan::where('remaining_balance', 0)->count();
        $ongoingCount = InstallmentPlan::where('remaining_balance', '>', 0)->count();

        // Calculate total penalties across all plans
        $totalPenalties = InstallmentPlan::with('payments')
            ->get()
            ->reduce(function ($carry, $plan) {
                return $carry + $plan->totalPenalties();
            }, 0);
    }

    // Data for the Dashboard
    $data = [
        'totalRevenue' => $totalRevenue,
        'outstandingBalances' => $outstandingBalances,
        'completedCount' => $completedCount,
        'ongoingCount' => $ongoingCount,
        'totalPenalties' => $totalPenalties, // Add penalties data
        'selectedPlan' => $planId ? $selectedPlan : null,
    ];

    return view('reports.index', compact('data', 'plans'));
}
}