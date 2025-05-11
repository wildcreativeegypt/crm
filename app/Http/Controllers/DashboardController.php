<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\AdAccount;
use App\Models\AdExpense;
use App\Models\Payment;
use App\Models\PersonalExpense;
use App\Models\PersonalInstallment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the CRM overview.
     */
    public function index()
    {
        // Total clients
        $clientCount = Client::count();

        // Total balance across all ad accounts (uses the balance accessor)
        $totalAdBalance = AdAccount::all()->sum('balance');

        // Total ad spend logged
        $totalAdExpenses = AdExpense::sum(DB::raw('amount + credit_card_fee_amount'));

        // Total payments received (gross)
        $totalPayments = Payment::sum('amount');

        // Total personal expenses
        $totalPersonalExpenses = PersonalExpense::sum('amount');

        // Upcoming installments (unpaid)
        $upcomingInstallments = PersonalInstallment::where('paid', false)->count();

        return view('dashboard.index', compact(
            'clientCount',
            'totalAdBalance',
            'totalAdExpenses',
            'totalPayments',
            'totalPersonalExpenses',
            'upcomingInstallments'
        ));
    }
}
