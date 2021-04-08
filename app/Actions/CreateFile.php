<?php

namespace App\Actions;

use App\DataTransferObjects\File;
use App\Models\File as FileModel;

class CreateFile
{
    public function __invoke(File $file): FileModel
    {
        return FileModel::create([
            'types' => $file->types,
            'min_size' => $file->minSize,
            'max_size' => $file->maxSize,
            'file_expires_in' => $file->fileExpires,
            'link_expires' => now()->addSeconds($file->linkExpires)
        ]);
    }
}