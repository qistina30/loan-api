<?php

namespace App\Services;

use App\Models\Loan;

class LoanSummaryService
{
    public function getSummary(Loan $loan): array
    {
        // Sum repayments in cents
        $totalPaid = $loan->repayments()->sum('amount_cents');

        // Calculate outstanding
        $outstanding = (int)$loan->principal_cents - $totalPaid;

        return [
            'total_paid_cents' => (string) $totalPaid,
            'outstanding_principal_cents' => (string) max($outstanding, 0),
        ];
    }
}
