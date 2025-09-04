<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repayment extends Model
{
    use HasFactory;
    protected $fillable = ['loan_id', 'paid_at', 'amount_cents'];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}
