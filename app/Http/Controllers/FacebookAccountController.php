<?php

namespace App\Http\Controllers;

use App\Models\FacebookAccount;
use Illuminate\Http\Request;

class FacebookAccountController extends Controller
{
    public function index()
    {
        $accounts = FacebookAccount::all();
        return view('facebook_accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('facebook_accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_id' => 'required|string|unique:facebook_accounts',
            'current_balance' => 'nullable|numeric|min:0',
        ]);

        FacebookAccount::create($request->all());

        // Redirect to the correct route
        return redirect()->route('facebook-accounts.index')->with('success', 'Facebook account added successfully.');
    }

    public function destroy(FacebookAccount $facebookAccount)
    {
        // Delete the Facebook account
        $facebookAccount->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('facebook-accounts.index')->with('success', 'Facebook account deleted successfully.');
    }
	public function edit(FacebookAccount $facebookAccount)
{
    return view('facebook_accounts.edit', compact('facebookAccount'));
}
public function update(Request $request, FacebookAccount $facebookAccount)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'account_id' => 'required|string|unique:facebook_accounts,account_id,' . $facebookAccount->id,
        'current_balance' => 'nullable|numeric|min:0',
    ]);

    $facebookAccount->update($request->all());

    // Redirect to the index page with a success message
    return redirect()->route('facebook-accounts.index')->with('success', 'Facebook account updated successfully.');
}
}