<?php

namespace App\Http\Controllers;

use App\Domain\IncomeSources\Actions\GetIncomeSourcesAction;
use App\Domain\IncomeSources\Actions\StoreIncomeSourceAction;
use App\Domain\IncomeSources\Actions\UpdateIncomeSourceAction;
use App\Domain\IncomeSources\Models\IncomeSource;
use App\Http\Requests\IncomeSourceRequest;
use Illuminate\Http\JsonResponse;

class IncomeSourcesController extends Controller
{
    public function index(GetIncomeSourcesAction $getIncomeSourcesAction): JsonResponse
    {
        return response()->json($getIncomeSourcesAction->execute());
    }

    public function store(
        IncomeSourceRequest $request,
        StoreIncomeSourceAction $storeIncomeSourceAction,
    ): JsonResponse {
        $storeIncomeSourceAction->execute($request->incomeSourceData());

        return response()->json();
    }

    public function update(
        IncomeSource $incomeSource,
        IncomeSourceRequest $request,
        UpdateIncomeSourceAction $updateIncomeSourceAction,
    ): JsonResponse {
        $updateIncomeSourceAction->execute($incomeSource, $request->incomeSourceData());

        return response()->json();
    }
}
