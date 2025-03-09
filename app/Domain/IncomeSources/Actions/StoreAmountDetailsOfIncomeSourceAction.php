<?php

namespace App\Domain\IncomeSources\Actions;

use App\Data\IncomeSource\AmountDetailsOfIncomeSourceData;
use App\Domain\IncomeSources\Models\IncomeSource;
use App\Domain\IncomeSources\Models\AmountDetailOfIncomeSource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mavinoo\Batch\BatchFacade as Batch;

class StoreAmountDetailsOfIncomeSourceAction
{
    public function __invoke(IncomeSource $incomeSource, Collection $amountDetailsOfIncomeSource): void
    {
        
        $amountDetails = $amountDetailsOfIncomeSource
            ->reduce(function (array $amountDetails, AmountDetailsOfIncomeSourceData $data) use ($incomeSource) {
                ! $data->id
                    ? $amountDetails['toBeCreated']->push([
                        'id' => Str::orderedUuid()->toString(),
                        'income_source_id' => $incomeSource->id,
                        'amount' => $data->amount,
                        'valid_from' => $data->valid_from,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ])
                    : $amountDetails['toBeUpdated']->push([
                        'id' => $data->id,
                        'amount' => $data->amount,
                        'valid_from' => $data->valid_from,
                        'updated_at' => now(),
                    ]);

                return $amountDetails;
            }, [
                'toBeCreated' => collect(),
                'toBeUpdated' => collect(),
            ]);
            // dd($amountDetails['toBeCreated']->toArray());
            DB::table('amount_and_valid_date_of_income_sources')
            ->insert($amountDetails['toBeCreated']->toArray());

            Batch::update(
                new AmountDetailOfIncomeSource(),
                $amountDetails['toBeUpdated']->toArray(),
                'id'
            );
    }
}