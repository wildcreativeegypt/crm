<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PersonalInstallment;
use App\Models\AdAccountTopup;
use App\Models\PersonalExpense;

class ClientController extends Controller
{
    /**
     * Display a paginated, searchable listing of clients.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Client::orderBy('name');
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $clients = $query->paginate(15)->withQueryString();

        return view('clients.index', compact('clients', 'search'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created client.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Client::create($data);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client added.');
    }

    /**
     * Display the specified client profile with KPIs, expenses, and payments.
     */
    public function show(Client $client, Request $request)
    {
        // 1) Date filters (default to current month)
        $start = $request->query('start_date')
               ? Carbon::parse($request->query('start_date'))
               : Carbon::now()->startOfMonth();
        $end   = $request->query('end_date')
               ? Carbon::parse($request->query('end_date'))
               : Carbon::now()->endOfMonth();

        // 2) KPI calculations
        $installmentsDue = PersonalInstallment::where('paid', false)
            ->whereBetween('due_date', [$start->toDateString(), $end->toDateString()])
            ->sum('installment_amount');

        $funded = AdAccountTopup::whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->sum('amount');

        $spending = PersonalExpense::whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->sum('amount');

        // 3) Load this client’s ad expenses in range
        $adExpenses = $client->adExpenses()
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->latest()
            ->get();

        // 4) Load this client’s payments in range
        $payments = $client->payments()
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->latest()
            ->get();

        // 5) Return view with all data
        return view('clients.show', compact(
            'client',
            'start',
            'end',
            'installmentsDue',
            'funded',
            'spending',
            'adExpenses',
            'payments'
        ));
    }
}
