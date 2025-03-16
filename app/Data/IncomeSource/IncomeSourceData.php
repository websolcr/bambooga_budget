<?php

namespace App\Data\IncomeSource;

use Illuminate\Support\Collection;

class IncomeSourceData
{
    /**
     * @param  Collection<AmountDetailsOfIncomeSourceData>  $amountDetails
     */
    public function __construct(
        public string $name,
        public Collection $amountDetails,
        public ?string $id,
    ) {}
}
