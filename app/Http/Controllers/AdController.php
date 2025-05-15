<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import the Carbon class for date handling

class AdController extends Controller
{
    /**
     * Display a listing of ads.
     */
    public function index()
    {
        // Fetch all ads with their related client and Facebook account
        $ads = Ad::with('client', 'facebookAccount')->latest()->get();

        // Pass the data to the view
        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new ad.
     */
    public function create()
    {
        // Fetch all clients and their linked Facebook accounts
        $clients = Client::with('facebookAccount')->get();

        return view('ads.create', compact('clients'));
    }

    /**
     * Store a newly created ad in storage.
     */
    public function store(Request $request)
{
    $request->validate([
    'client_id' => 'required|exists:clients,id',
    'page_name' => 'required|string|max:255',
    'spend_amount' => 'required|numeric|min:0.01', // Validation for spend_amount field
    'date_from' => 'required|date',
    'date_to' => 'required|date|after_or_equal:date_from',
]);

    $client = Client::findOrFail($request->client_id);

    // Calculate tax and total cost
    $taxRate = 14; // Default tax rate
    $tax = $request->spend_amount * ($taxRate / 100);
    $totalCost = $request->spend_amount + $tax;

    // Loop through the date range to create ads for each day
    $startDate = Carbon::parse($request->date_from);
    $endDate = Carbon::parse($request->date_to);

    while ($startDate <= $endDate) {
        Ad::create([
            'client_id' => $client->id,
            'facebook_account_id' => $client->facebook_account_id,
            'page_name' => $request->page_name,
            'spend_amount' => $request->spend_amount, // Ensure this value is passed
            'tax_rate' => $taxRate,
            'total_cost' => $totalCost,
            'date' => $startDate->toDateString(), // Log the ad for the specific day
        ]);

        $startDate->addDay(); // Increment by one day
    }

    return redirect()->route('ads.index')->with('success', 'Ads logged successfully for the specified date range.');
}
}