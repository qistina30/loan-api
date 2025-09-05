<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Loan;
use Carbon\Carbon;

class LoanFlowTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_loan_adds_repayments_and_gets_summary()
    {
        // Step 1: Create a loan
        $loanResponse = $this->postJson('/api/loans', [
            'borrower_name'   => 'Alice',
            'principal_cents' => '1000000', // RM10,000.00
        ]);

        $loanResponse->assertStatus(201)
            ->assertJsonFragment(['borrower_name' => 'Alice']);

        $loanId = $loanResponse->json('id');

        // Step 2: Add first repayment
        $repayment1 = $this->postJson("/api/loans/{$loanId}/repayments", [
            'paid_at'      => Carbon::now()->toDateString(),
            'amount_cents' => '200000', // RM2,000
        ]);

        $repayment1->assertStatus(201);

        // Step 3: Add second repayment
        $repayment2 = $this->postJson("/api/loans/{$loanId}/repayments", [
            'paid_at'      => Carbon::now()->toDateString(),
            'amount_cents' => '300000', // RM3,000
        ]);

        $repayment2->assertStatus(201);

        // Step 4: Get loan summary
        $summary = $this->getJson("/api/loans/{$loanId}");

        $summary->assertStatus(200)
            ->assertJson([
                'borrower_name'   => 'Alice',
                'principal_cents' => "1000000",
                'summary' => [
                    'total_paid_cents' => "500000",
                    'outstanding_principal_cents' => "500000",
                ],
            ]);
    }
}
