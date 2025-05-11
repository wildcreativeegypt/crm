<?php

namespace App\Http\Controllers;

use App\Models\AdAccount;
use App\Models\AdAccountTopup;
use Illuminate\Http\Request;

class AdAccountTopupController extends Controller
{
    /**
     * Display a listing of top-ups.
     */
    public function index()
    {
        $topups = AdAccountTopup::with('account')->latest()->get();
        return view('ad_account_topups.index', compact('topups'));
    }

    /**
     * Show form to create a top-up.
     */
    public function create()
    {
        $accounts = AdAccount::all();
        return view('ad_account_topups.create', compact('accounts'));
    }

    /**
     * Store a new top-up.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ad_account_id' => 'required|exists:ad_accounts,id',
            'date'          => 'required|date',
            'amount'        => 'required|numeric|min:0',
            'notes'         => 'nullable|string',
        ]);

        // Default currency is EGP
        $data['currency'] = 'EGP';

        AdAccountTopup::create($data);

        return redirect()->route('ad_account_topups.index')
                         ->with('success', 'Top-up recorded.');
    }
}
