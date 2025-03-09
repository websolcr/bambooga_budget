<?php

namespace App\Http\Requests;

use App\Domain\IncomeSources\Models\IncomeSource;
use App\Data\IncomeSource\IncomeSourceData;
use App\Data\IncomeSource\AmountDetailsOfIncomeSourceData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;


class StoreIncomeSourceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'amount_details.*.amount' => 'required',
            'amount_details.*.valid_from' => 'required|date',
        ];
    }

    public function incomeSourceData(): IncomeSourceData
    {
        return new IncomeSourceData(
            request('name'),
            request('id')
        );
    }

    public function amountDetailsOfIncomeSource(): Collection
    {
        return collect(request('amount_details'))->map(function (array $amountDetails) {
            return new AmountDetailsOfIncomeSourceData(
                amount: $amountDetails['amount'],
                valid_from: $amountDetails['valid_from'],
                id: $amountDetails['id'],
            );
        });
    }
}
