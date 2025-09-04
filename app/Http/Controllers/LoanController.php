<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\LoanSummaryService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Create a loan
    public function store(Request $request)
    {
        $data = $request->validate([
            'borrower_name' => 'required|string',
            'principal_cents' => 'required|regex:/^\d+$/',
        ]);

        $loan = Loan::create($data);

        return response()->json($loan, 201);
    }

    // Show loan + summary
    public function show(Loan $loan)
    {
        $totalPaid = $loan->repayments()->sum('amount_cents');
        $outstanding = (int) $loan->principal_cents - $totalPaid;

        return response()->json([
            'id' => $loan->id,
            'borrower_name' => $loan->borrower_name,
            'principal_cents' => $loan->principal_cents,
            'summary' => [
                'total_paid_cents' => (string) $totalPaid,
                'outstanding_principal_cents' => (string) max($outstanding, 0),
            ],
        ]);
    }
}
