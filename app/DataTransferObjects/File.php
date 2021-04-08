<?php

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class File extends DataTransferObject
{
    public ?array $types;
    public ?int $minSize;
    public ?int $maxSize;
    public int $linkExpires;
    public int $fileExpires;
}