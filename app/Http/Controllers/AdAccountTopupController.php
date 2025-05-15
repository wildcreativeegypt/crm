<?php

namespace App\Http\Controllers;

use App\Models\AdAccountTopup;
use App\Models\AdAccount;
use Illuminate\Http\Request;

class AdAccountTopupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Eager-load the related AdAccount, order by date desc, paginate 10 per page
        $topups = AdAccountTopup::with('account')
                    ->orderBy('date', 'desc')
                    ->paginate(10);

        return view('ad_account_topups.index', compact('topups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Need these for the select dropdown
        $accounts = AdAccount::orderBy('name')->get();

        return view('ad_account_topups.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ad_account_id' => ['required', 'exists:ad_accounts,id'],
            'date'          => ['required', 'date'],
            'amount'        => ['required', 'numeric', 'min:0'],
            'notes'         => ['nullable', 'string'],
        ]);

        AdAccountTopup::create($data);

        return redirect()
            ->route('ad_account_topups.index')
            ->with('success', 'Top-up recorded successfully.');
    }

    // ... other methods (show, edit, update, destroy) unchanged ...
}
