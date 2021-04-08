<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\GoneHttpException;

class DownloadFileController extends Controller
{
    public function __invoke(File $file)
    {
        if ($file->fileHasExpired()) {
            throw new GoneHttpException('File has expired');
        }

        return Storage::download($file->path);
    }
}
