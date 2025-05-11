<?php

namespace App\Http\Controllers;

use App\Models\AdExpense;
use App\Models\AdAccount;
use Illuminate\Http\Request;

class AdExpenseController extends Controller
{
    /**
     * Display a listing of ad expenses, with optional filters.
     */
    public function index(Request $request)
    {
        // Fetch filter inputs, defaulting to current month
        $accountId = $request->query('account_id');
        $search    = $request->query('search');
        $start     = $request->query('start_date') ?? now()->startOfMonth()->toDateString();
        $end       = $request->query('end_date')   ?? now()->endOfMonth()->toDateString();

        // Base query
        $query = AdExpense::with('account')
                  ->whereBetween('date', [$start, $end]);

        // Account filter
        if ($accountId) {
            $query->where('ad_account_id', $accountId);
        }

        // Text search in notes
        if ($search) {
            $query->where('notes', 'like', "%{$search}%");
        }

        // Paginate results
        $expenses = $query->latest()->paginate(15)->withQueryString();

        // For the account dropdown
        $accounts = AdAccount::orderBy('name')->get();

        return view('ad_expenses.index', compact(
            'expenses', 'accounts', 'accountId', 'search', 'start', 'end'
        ));
    }

    // create() and store() remain unchanged...
}
