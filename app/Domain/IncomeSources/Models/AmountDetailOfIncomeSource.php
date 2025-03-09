<?php

namespace App\Domain\IncomeSources\Models;

use App\Models\BaseModel;
use App\Domain\IncomeSources\Models\IncomeSource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AmountDetailOfIncomeSource extends BaseModel
{
    protected $table = 'amount_and_valid_date_of_income_sources';

    protected $fillable = [
        'income_source_id',
        'amount',
        'valid_from'
    ];

    public function IncomeSource(): BelongsTo
    {
        return $this->belongsTo(IncomeSource::class);
    }
}