<?php

namespace App\Domain\IncomeSources\Actions;

use App\Domain\IncomeSources\Models\IncomeSource;
use App\Data\IncomeSource\IncomeSourceData;

class StoreIncomeSourceAction
{
    public function __invoke(IncomeSourceData $incomeSourceData): IncomeSource
    {
        $incomeSource = IncomeSource::create([
            'name' => $incomeSourceData->name,
        ]);

        return $incomeSource;
    }
}