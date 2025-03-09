<?php

namespace App\Data\IncomeSource;

class IncomeSourceData
{
    public function __construct(
        public string $name,
        public ?string $id = null,
    ) {
    }
}
