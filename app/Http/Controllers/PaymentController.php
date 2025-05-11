<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments with optional filters.
     */
    public function index(Request $request)
    {
        // Filter inputs, defaulting to current month
        $start  = $request->query('start_date') ?? now()->startOfMonth()->toDateString();
        $end    = $request->query('end_date')   ?? now()->endOfMonth()->toDateString();
        $search = $request->query('search');

        // Build query
        $query = Payment::whereBetween('date', [$start, $end]);

        // Keyword search on invoice_id or method
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('invoice_id', 'like', "%{$search}%")
                  ->orWhere('method', 'like', "%{$search}%");
            });
        }

        // Paginate with query string
        $payments = $query->latest()->paginate(15)->withQueryString();

        return view('payments.index', compact('payments', 'start', 'end', 'search'));
    }

    // create() and store() remain unchanged...
}
