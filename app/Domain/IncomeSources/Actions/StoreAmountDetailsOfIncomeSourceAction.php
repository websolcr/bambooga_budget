<?php

namespace App\Domain\IncomeSources\Actions;

use App\Data\IncomeSource\AmountDetailsOfIncomeSourceData;
use App\Domain\IncomeSources\Models\AmountDetailOfIncomeSource;
use App\Domain\IncomeSources\Models\IncomeSource;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class StoreAmountDetailsOfIncomeSourceAction
{
    public function execute(IncomeSource $incomeSource, Collection $amountDetailsOfIncomeSource): void
    {
        $amountDetails = $amountDetailsOfIncomeSource
            ->reduce(function (array $amountDetails, AmountDetailsOfIncomeSourceData $data) use ($incomeSource) {
                $details = [
                    'id' => $data->id,
                    'income_source_id' => $incomeSource->getKey(),
                    'amount' => $data->amount,
                    'valid_from' => $data->valid_from,
                    'updated_at' => now()->toDateTimeString(),
                ];

                if (! $data->id) {
                    $details['id'] = Str::orderedUuid()->toString();
                    $details['created_at'] = now()->toDateTimeString();
                }

                $amountDetails[$data->id ? 'toBeUpdated' : 'toBeCreated']->push($details);

                return $amountDetails;
            }, [
                'toBeCreated' => collect(),
                'toBeUpdated' => collect(),
            ]);

        AmountDetailOfIncomeSource::insert($amountDetails['toBeCreated']->toArray());

        AmountDetailOfIncomeSource::batchUpdate($amountDetails['toBeUpdated']->toArray(), 'id');
    }
}
