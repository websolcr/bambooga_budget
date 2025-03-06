<?php

namespace App\Domain\IncomeSources\Models;

use App\Models\BaseModel;

class IncomeSource extends BaseModel
{
    protected $fillable = [
        'name',
    ];
}