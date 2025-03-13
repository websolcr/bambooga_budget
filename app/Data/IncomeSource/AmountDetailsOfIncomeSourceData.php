<?php

namespace App\Data\IncomeSource;

class AmountDetailsOfIncomeSourceData
{
    public function __construct(
        public int $amount,
        public string $valid_from,
        public ?string $id = null,
    ) {}
}
