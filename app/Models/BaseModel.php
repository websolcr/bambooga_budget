<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class BaseModel extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::orderedUuid()->toString();
        });
    }

    public function getDirtyAuditable(array $omitFields = []): array
    {
        $array = $this->getDirty();

        foreach (array_merge(['created_at', 'updated_at'], $omitFields) as $omitField) {
            Arr::forget($array, $omitField);
        }

        return $array;
    }
}
