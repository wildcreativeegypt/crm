<?php

namespace App\Http\Controllers;

use App\Models\InstallmentPlan;
use App\Models\InstallmentPayment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    // List all installment plans
    public function index()
    {
        $plans = InstallmentPlan::all();
        return view('installments.index', compact('plans'));
    }

    public function showRescheduleForm(InstallmentPlan $plan)
    {
        return view('installments.reschedule', compact('plan'));
    }

    // Show a single installment plan
    public function show(InstallmentPlan $plan)
    {
        return view('installments.show', compact('plan'));
    }

    // Show the form to create a new installment plan
    public function create()
    {
        return view('installments.create');
    }

    // Store a new installment plan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'monthly_installment' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1',
            'start_date' => 'required|date',
        ]);

        InstallmentPlan::create(array_merge($validated, [
            'amount_paid' => 0,
            'remaining_balance' => $validated['total_amount'],
        ]));

        return redirect()->route('installments.index')->with('status', 'Installment Plan created successfully.');
    }

    // Add a payment to an installment plan
    public function pay(Request $request, InstallmentPlan $plan)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'penalty_amount' => 'nullable|numeric|min:0', // Validate penalty amount
            'payment_date' => 'required|date',
        ]);

        $payment = new InstallmentPayment([
            'amount' => $validated['amount'],
            'penalty_amount' => $validated['penalty_amount'] ?? 0, // Default penalty amount to 0 if not provided
            'payment_date' => $validated['payment_date'],
        ]);

        $plan->payments()->save($payment);
        $plan->amount_paid += $validated['amount'];
        $plan->remaining_balance = $plan->calculateRemainingBalance();
        $plan->save();

        return redirect()->route('installments.show', $plan)->with('status', 'Payment recorded successfully.');
    }

    public function reschedule(Request $request, InstallmentPlan $plan)
    {
        $validated = $request->validate([
            'rescheduled_date' => 'required|date|after_or_equal:' . $plan->start_date,
        ]);

        // Update the start_date or rescheduled_date field
        $plan->update([
            'start_date' => $validated['rescheduled_date'], // Ensure this updates the start_date
        ]);

        return redirect()->route('installments.show', $plan)
            ->with('status', 'Installment plan rescheduled successfully.');
    }

    public function delete(InstallmentPlan $plan)
    {
        // Ensure any associated payments are deleted to avoid orphan records
        $plan->payments()->delete();

        // Delete the installment plan itself
        $plan->delete();

        return redirect()->route('installments.index')
            ->with('status', 'Installment plan deleted successfully.');
    }

    public function removePayment(InstallmentPlan $plan, InstallmentPayment $payment)
    {
        // Ensure the payment belongs to the given installment plan
        if ($plan->id !== $payment->installment_plan_id) {
            return redirect()->route('installments.show', $plan)
                ->withErrors(['error' => 'This payment does not belong to the specified installment plan.']);
        }

        // Revert the payment amount in the installment plan's balance
        $plan->amount_paid -= $payment->amount;
        $plan->remaining_balance += $payment->amount;

        // Save the updated installment plan
        $plan->save();

        // Delete the payment
        $payment->delete();

        return redirect()->route('installments.show', $plan)
            ->with('status', 'Payment removed successfully.');
    }

    /**
     * Generate Installment Reports & Analytics
     */
    public function reports()
    {
        // Fetch all plans with their payments
        $plans = InstallmentPlan::with('payments')->get();

        // Prepare report data by mapping over the plans
        $reportData = $plans->map(function ($plan) {
            return [
                'name' => $plan->name,
                'total_amount' => $plan->total_amount,
                'amount_paid' => $plan->amount_paid,
                'remaining_balance' => $plan->remaining_balance,
                'total_penalties' => $plan->totalPenalties(), // Use the totalPenalties method from the InstallmentPlan model
            ];
        });

        // Pass the report data to the reports view
        return view('installments.reports', compact('reportData'));
    }
}