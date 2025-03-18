<?php

namespace App\Domain\IncomeSources\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IncomeSource extends BaseModel
{
    public const PAYMENT_CYCLES = [
        'MONTHLY' => 1,
        'ONE_TIME' => 2,
    ];

    public function amountDetails(): HasMany
    {
        return $this->hasMany(AmountDetailOfIncomeSource::class);
    }

    public function paymentCycle(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value ? array_search($value, self::PAYMENT_CYCLES) : null,
            set: fn ($value) => $value ? self::PAYMENT_CYCLES[$value] : null,
        );
    }
}
