<?php

namespace App\Http\Controllers;

use App\Actions\UploadFile;
use App\Http\Requests\UploadFileRequest;
use App\Http\Resources\UploadedFileResource;
use App\Models\File;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\GoneHttpException;

class UploadFileController extends Controller
{
    public function __invoke(File $file, UploadFileRequest $request, UploadFile $uploadFile)
    {
        if ($file->linkHasExpired()) {
            throw new GoneHttpException('Link has expired');
        }

        if ($file->hasBeenUploaded()) {
            throw new ConflictHttpException('File already uploaded');
        }

        $file = $uploadFile(
            $file,
            $request->file
        );

        return new UploadedFileResource($file);
    }
}
