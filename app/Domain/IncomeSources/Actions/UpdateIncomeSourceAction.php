<?php

namespace App\Domain\IncomeSources\Actions;

use App\Domain\IncomeSources\Models\IncomeSource;
use Illuminate\Support\Arr;

class UpdateIncomeSourceAction
{
    public function execute(IncomeSource $incomeSource, array $data): IncomeSource
    {
        $incomeSource->fill([
            'name' => Arr::get($data, 'name'),
        ]);

        $incomeSource->save();

        return $incomeSource;
    }
}
