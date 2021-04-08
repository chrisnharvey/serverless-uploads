<?php

namespace App\Actions;

use App\Models\File;
use Illuminate\Http\UploadedFile;

class UploadFile
{
    public function __invoke(File $file, UploadedFile $uploadedFile): File
    {
        $file->name = $uploadedFile->getClientOriginalName();
        $file->path = $uploadedFile->store('');
        $file->size = $uploadedFile->getSize();
        $file->mimetype = $uploadedFile->getMimeType();
        $file->file_expires = now()->addSeconds($file->file_expires_in);

        $file->save();

        return $file;
    }
}