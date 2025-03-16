<?php

namespace App\Data\IncomeSource;

class AmountDetailsOfIncomeSourceData
{
    public function __construct(
        public int $amount,
        public string $valid_from,
        public string $valid_end,
        public String $payment_cycle,
        public ?string $id = null,
    ) {}
}
