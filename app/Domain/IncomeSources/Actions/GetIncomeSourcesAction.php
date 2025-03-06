<?php

namespace App\Domain\IncomeSources\Actions;

use App\Domain\IncomeSources\Models\IncomeSource;
use Illuminate\Support\Collection;

class GetIncomeSourcesAction
{
    public function execute(): Collection
    {
        return IncomeSource::all();
    }
}
