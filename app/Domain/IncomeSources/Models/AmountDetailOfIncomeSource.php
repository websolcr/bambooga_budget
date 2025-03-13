<?php

namespace App\Domain\IncomeSources\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mavinoo\Batch\Traits\HasBatch;

class AmountDetailOfIncomeSource extends BaseModel
{
    use HasBatch;

    protected $table = 'amount_and_valid_date_of_income_sources';

    public function incomeSource(): BelongsTo
    {
        return $this->belongsTo(IncomeSource::class);
    }
}
