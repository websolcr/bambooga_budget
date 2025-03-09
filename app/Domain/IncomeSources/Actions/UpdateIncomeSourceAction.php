<?php

namespace App\Domain\IncomeSources\Actions;

use App\Domain\IncomeSources\Models\IncomeSource;
use App\Data\IncomeSource\IncomeSourceData;

class UpdateIncomeSourceAction
{
    public function __invoke(IncomeSource $incomeSource, IncomeSourceData $incomeData): IncomeSource
    {
        $incomeSource->update([
            'name' => $incomeData->name,
        ]);

        return $incomeSource;
    }

}
