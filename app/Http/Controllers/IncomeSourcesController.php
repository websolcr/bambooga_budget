<?php

namespace App\Http\Controllers;

use App\Domain\IncomeSources\Actions\GetIncomeSourcesAction;
use App\Domain\IncomeSources\Actions\StoreIncomeSourceAction;
use App\Domain\IncomeSources\Actions\UpdateIncomeSourceAction;
use App\Http\Requests\StoreIncomeSourceRequest;
use App\Http\Requests\UpdateIncomeSourceRequest;
use App\Domain\IncomeSources\Models\IncomeSource;
use Illuminate\Http\JsonResponse;

class IncomeSourcesController extends Controller
{
    public function index(GetIncomeSourcesAction $getIncomeSourcesAction): JsonResponse
    {
        return response()->json($getIncomeSourcesAction->execute());
    }
    
    public function store(
        StoreIncomeSourceRequest $request,
        StoreIncomeSourceAction $storeIncomeSourceAction
    ): JsonResponse {
        $storeIncomeSourceAction->execute($request->validated());

        return response()->json();
    }

    public function update(
        IncomeSource $incomeSource,
        StoreIncomeSourceRequest $request,
        UpdateIncomeSourceAction $updateIncomeSourceAction
    ): JsonResponse {
        $updateIncomeSourceAction->execute($incomeSource, $request->validated());

        return response()->json();
    }
}
