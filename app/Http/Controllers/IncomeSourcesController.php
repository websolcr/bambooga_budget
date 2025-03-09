<?php

namespace App\Http\Controllers;

use App\Domain\IncomeSources\Actions\GetIncomeSourcesAction;
use App\Domain\IncomeSources\Actions\StoreIncomeSourceAction;
use App\Domain\IncomeSources\Actions\StoreAmountDetailsOfIncomeSourceAction;
use App\Domain\IncomeSources\Actions\UpdateIncomeSourceAction;
use App\Http\Requests\StoreIncomeSourceRequest;
use App\Http\Requests\UpdateIncomeSourceRequest;
use App\Domain\IncomeSources\Models\IncomeSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class IncomeSourcesController extends Controller
{
    public function index(GetIncomeSourcesAction $getIncomeSourcesAction): JsonResponse
    {
        return response()->json($getIncomeSourcesAction->execute());
    }
    
    public function store(
        StoreIncomeSourceRequest $request,
        StoreIncomeSourceAction $storeIncomeSourceAction,
        StoreAmountDetailsOfIncomeSourceAction $storeAmountDetailsOfIncomeSourceAction,
    ): JsonResponse {
        DB::beginTransaction();
        // dd($request->toArray());
        try {
           $incomeSource = $storeIncomeSourceAction($request->incomeSourceData());
           
           $storeAmountDetailsOfIncomeSourceAction($incomeSource, $request->amountDetailsOfIncomeSource());
        //    dd($storeAmountDetailsOfIncomeSourceAction);
           DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return response()->json();
    }

    public function update(
        IncomeSource $incomeSource,
        StoreIncomeSourceRequest $request,
        UpdateIncomeSourceAction $updateIncomeSourceAction,
        StoreAmountDetailsOfIncomeSourceAction $storeAmountDetailsOfIncomeSourceAction
    ): JsonResponse {
        DB::beginTransaction();

        try {
            $updateIncomeSourceAction($incomeSource, $request->incomeSourceData());

            $storeAmountDetailsOfIncomeSourceAction($incomeSource, $request->amountDetailsOfIncomeSource());

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return response()->json();
    }
}
