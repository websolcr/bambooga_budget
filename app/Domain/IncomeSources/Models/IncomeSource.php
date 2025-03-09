<?php

namespace App\Domain\IncomeSources\Models;

use App\Models\BaseModel;
use App\Domain\IncomeSources\Models\AmountDetailOfIncomeSource;
use Illuminate\Database\Eloquent\Relations\HasMany;


class IncomeSource extends BaseModel
{
    protected $fillable = [
        'name',
    ];

    public function AmountDetails(): HasMany
    {
        return $this->hasMany(AmountDetailOfIncomeSource::class);
    }
}