<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Loan;
use App\Models\Repayment;
use App\Services\LoanSummaryService;
use PHPUnit\Framework\Attributes\Test;

class LoanSummaryServiceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_calculates_summary_correctly()
    {
        $loan = Loan::factory()->create([
            'principal_cents' => '1000000', // 10,000.00
        ]);

        Repayment::factory()->create([
            'loan_id' => $loan->id,
            'amount_cents' => '200000',
        ]);

        Repayment::factory()->create([
            'loan_id' => $loan->id,
            'amount_cents' => '300000',
        ]);

        $service = new LoanSummaryService();
        $summary = $service->getSummary($loan);

        $this->assertEquals("500000", $summary['total_paid_cents']);
        $this->assertEquals("500000", $summary['outstanding_principal_cents']);
    }
}
