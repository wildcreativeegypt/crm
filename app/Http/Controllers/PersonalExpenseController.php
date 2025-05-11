<?php

namespace App\Http\Controllers;

use App\Models\PersonalExpense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PersonalExpenseController extends Controller
{
    /**
     * Display a listing of personal expenses.
     */
    public function index(Request $request)
    {
        // 1) Parse filters, defaulting to current month
        $start = $request->query('start_date')
            ? Carbon::parse($request->query('start_date'))->startOfDay()
            : Carbon::now()->startOfMonth()->startOfDay();
        $end = $request->query('end_date')
            ? Carbon::parse($request->query('end_date'))->endOfDay()
            : Carbon::now()->endOfMonth()->endOfDay();

        $search = $request->query('search', '');

        // 2) Build query
        $query = PersonalExpense::whereBetween('date', [
            $start->toDateString(),
            $end->toDateString(),
        ]);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('category', 'like', "%{$search}%")
                  ->orWhere('notes',    'like', "%{$search}%");
            });
        }

        // 3) Get paginated results (preserve query string)
        $expenses = $query
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();

        // 4) Return view
        return view('personal.expenses.index', compact(
            'expenses',
            'start',
            'end',
            'search'
        ));
    }

    /**
     * Show the form for creating a new personal expense.
     */
    public function create()
    {
        return view('personal.expenses.create');
    }

    /**
     * Store a newly created personal expense.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'date'     => 'required|date',
            'category' => 'required|string|max:255',
            'amount'   => 'required|numeric',
            'notes'    => 'nullable|string',
        ]);

        PersonalExpense::create($data);

        return redirect()
            ->route('personal.expenses.index')
            ->with('success', 'Expense added.');
    }
}
