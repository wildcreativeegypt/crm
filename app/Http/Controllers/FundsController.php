<?php

namespace App\Http\Controllers;

use App\Models\FacebookAccount;
use App\Utils\TaxCalculator;
use Illuminate\Http\Request;

class FundsController extends Controller
{
    /**
     * Add funds to a Facebook account.
     *
     * @param Request $request
     * @param int $accountId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFunds(Request $request, $accountId)
    {
        // Validate the input
        $request->validate([
            'funds_added' => 'required|numeric|min:0',
        ]);

        // Get the funds added from the request
        $fundsAdded = $request->input('funds_added');

        // Calculate the net amount (excluding tax)
        $netAmount = TaxCalculator::calculateNetAmount($fundsAdded);

        // Find the Facebook account or fail
        $facebookAccount = FacebookAccount::findOrFail($accountId);

        // Update the account's funds and net amount
        $facebookAccount->funds_added = $fundsAdded;
        $facebookAccount->net_amount = $netAmount;
        $facebookAccount->save();

        // Return a success response
        return response()->json([
            'message' => 'Funds added successfully.',
            'funds_added' => $fundsAdded,
            'net_amount' => $netAmount,
        ]);
    }
}