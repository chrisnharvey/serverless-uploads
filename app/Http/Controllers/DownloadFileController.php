<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\GoneHttpException;

class DownloadFileController extends Controller
{
    public function __invoke(File $file, Request $request)
    {
        if ($file->fileHasExpired()) {
            throw new GoneHttpException('File has expired');
        }

        try {
            $verificationToken = Crypt::decryptString($request->token);

            if ($verificationToken !== $file->verification_token) {
                throw new BadRequestHttpException('Invalid verification token');
            }
        } catch (DecryptException) {
            throw new BadRequestHttpException('Unable to decrypt verification token');
        }

        return Storage::download($file->path);
    }
}
