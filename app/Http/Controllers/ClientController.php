<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FacebookAccount;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
{
    $clients = Client::with('facebookAccount')->paginate(10); // 10 items per page
    return view('clients.index', compact('clients'));
}

    public function create()
    {
        $facebookAccounts = FacebookAccount::all();
        return view('clients.create', compact('facebookAccounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'facebook_account_id' => 'required|exists:facebook_accounts,id',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client added successfully.');
    }

    public function edit(Client $client)
    {
        $facebookAccounts = FacebookAccount::all();
        return view('clients.edit', compact('client', 'facebookAccounts'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'facebook_account_id' => 'required|exists:facebook_accounts,id',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}