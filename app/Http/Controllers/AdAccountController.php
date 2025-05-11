<?php

namespace App\Http\Controllers;

use App\Models\AdAccount;
use Illuminate\Http\Request;

class AdAccountController extends Controller
{
    /**
     * Display a listing of ad accounts.
     */
    public function index()
    {
        // Eager‐load topups so we can compute balances
        $accounts = AdAccount::with('topups')->get();
        return view('ad_accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new ad account.
     */
    public function create()
    {
        return view('ad_accounts.create');
    }

    /**
     * Store a newly created ad account.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'currency' => 'required|string|size:3',
        ]);

        AdAccount::create($data);

        return redirect()->route('ad_accounts.index')
                         ->with('success', 'Ad Account created.');
    }

    /**
     * Display the specified ad account.
     */
    public function show(AdAccount $adAccount)
    {
        $adAccount->load('topups', 'expenses');
        return view('ad_accounts.show', compact('adAccount'));
    }
}
