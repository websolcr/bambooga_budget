<?php

namespace App\Domain\IncomeSources\Actions;

use App\Domain\IncomeSources\Models\IncomeSource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Throwable;

class StoreIncomeSourceAction
{
    public function execute(array $data): IncomeSource
    {
        DB::beginTransaction();

        try {
            $incomeSource = IncomeSource::create([
                'name' => Arr::get($data, 'name'),
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    
        return $incomeSource;
    }
}