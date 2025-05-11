<?php

namespace App\Http\Controllers;

use App\Models\PersonalInstallment;
use Illuminate\Http\Request;

class PersonalInstallmentController extends Controller
{
    public function index(Request $request)
    {
        $start  = $request->query('start_date') ?? now()->startOfMonth()->toDateString();
        $end    = $request->query('end_date')   ?? now()->endOfMonth()->toDateString();
        $search = $request->query('search');

        $query = PersonalInstallment::whereBetween('due_date', [$start, $end]);

        if ($search) {
            $query->where('payee', 'like', "%{$search}%");
        }

        $installments = $query->latest()->paginate(15)->withQueryString();

        return view('personal.installments.index', compact('installments','start','end','search'));
    }

    public function create()
    {
        return view('personal.installments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'payee'              => 'required|string|max:255',
            'installment_amount' => 'required|numeric|min:0',
            'due_date'           => 'required|date',
            'frequency'          => 'required|in:weekly,monthly,quarterly,custom',
            'paid'               => 'sometimes|boolean',
        ]);

        $data['user_id']  = auth()->id() ?? 1;
        $data['currency'] = 'EGP';

        PersonalInstallment::create($data);

        return redirect()
            ->route('personal.installments.index')
            ->with('success', 'Installment scheduled.');
    }
}
