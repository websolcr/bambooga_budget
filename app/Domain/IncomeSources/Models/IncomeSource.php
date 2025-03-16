<?php

namespace App\Domain\IncomeSources\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IncomeSource extends BaseModel
{
    public function amountDetails(): HasMany
    {
        return $this->hasMany(AmountDetailOfIncomeSource::class);
    }
}
