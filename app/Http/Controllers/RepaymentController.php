<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    // Add repayment to a loan
    public function store(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'paid_at' => 'required|date',
            'amount_cents' => 'required|regex:/^\d+$/',
        ]);

        $repayment = $loan->repayments()->create($validated);

        return response()->json($repayment, 201);
    }
}
