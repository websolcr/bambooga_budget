<?php

namespace App\Domain\IncomeSources\Actions;

use App\Data\IncomeSource\IncomeSourceData;
use App\Domain\IncomeSources\Models\IncomeSource;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreIncomeSourceAction
{
    public function __construct(private StoreAmountDetailsOfIncomeSourceAction $storeAmountDetailsOfIncomeSourceAction) {}

    public function execute(IncomeSourceData $incomeSourceData): void
    {
        DB::beginTransaction();

        try {
            $incomeSource = IncomeSource::create([
                'name' => $incomeSourceData->name,
                'payment_cycle' => $incomeSourceData->paymentCycle,
            ]);

            $this->storeAmountDetailsOfIncomeSourceAction->execute(
                $incomeSource,
                $incomeSourceData->amountDetails
            );

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
