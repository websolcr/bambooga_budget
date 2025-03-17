<?php

namespace App\Domain\IncomeSources\Actions;

use App\Data\IncomeSource\IncomeSourceData;
use App\Domain\IncomeSources\Models\IncomeSource;
use Illuminate\Support\Facades\DB;

class UpdateIncomeSourceAction
{
    public function __construct(private StoreAmountDetailsOfIncomeSourceAction $storeAmountDetailsOfIncomeSourceAction) {}

    public function execute(IncomeSource $incomeSource, IncomeSourceData $incomeData): void
    {
        DB::beginTransaction();

        try {
            $incomeSource->update([
                'name' => $incomeData->name,
                'payment_cycle' => $incomeData->paymentCycle,
            ]);

            $this->storeAmountDetailsOfIncomeSourceAction->execute(
                $incomeSource,
                $incomeData->amountDetails
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
