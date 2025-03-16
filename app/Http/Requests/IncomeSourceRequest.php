<?php

namespace App\Http\Requests;

use App\Domain\IncomeSources\Models\AmountDetailOfIncomeSource;
use App\Data\IncomeSource\AmountDetailsOfIncomeSourceData;
use App\Data\IncomeSource\IncomeSourceData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class IncomeSourceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'amount_details.*.amount' => 'required',
            'amount_details.*.valid_from' => 'required|date',
            'amount_details.*.valid_end' => 'required|date',
            'amount_details.*.payment_cycle' => ['required', Rule::in(array_keys(AmountDetailOfIncomeSource::PAYMENT_CYCLES))],
        ];
    }

    public function incomeSourceData(): IncomeSourceData
    {
        return new IncomeSourceData(
            name: request('name'),
            amountDetails: $this->amountDetailsOfIncomeSource(),
            id: request('id'),
        );
    }

    /**
     * @return Collection<AmountDetailsOfIncomeSourceData>
     */
    private function amountDetailsOfIncomeSource(): Collection
    {
        return collect(request('amount_details'))->map(function (array $amountDetails) {
            return new AmountDetailsOfIncomeSourceData(
                amount: $amountDetails['amount'],
                valid_from: $amountDetails['valid_from'],
                valid_end: $amountDetails['valid_end'],
                payment_cycle: $amountDetails['payment_cycle'],
                id: $amountDetails['id'],
            );
        });
    }
}
