<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    public function __construct(array $attributes = [])
    {
        $this->keyType = 'string';
        $this->incrementing = false;

        parent::__construct($attributes);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid();
        });
    }
}