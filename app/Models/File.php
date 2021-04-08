<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'types',
        'min_size',
        'max_size',
        'file_expires_in',
        'link_expires',
    ];

    protected $casts = [
        'types' => 'array',
        'link_expires' => 'datetime',
        'file_expires' => 'datetime',
    ];

    public function linkHasExpired(): bool
    {
        return $this->link_expires->isPast();
    }

    public function fileHasExpired(): bool
    {
        return $this->file_expires?->isPast() === true;
    }

    public function hasBeenUploaded(): bool
    {
        return $this->path !== null;
    }
}
