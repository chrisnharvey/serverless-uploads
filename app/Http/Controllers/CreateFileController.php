<?php

namespace App\Http\Controllers;

use App\Actions\CreateFile;
use App\DataTransferObjects\File;
use App\Http\Requests\CreateFileRequest;
use App\Http\Resources\FileResource;

class CreateFileController extends Controller
{
    public function __invoke(CreateFileRequest $request, CreateFile $createFile)
    {
        $file = $createFile(
            new File($request->validated())
        );

        return new FileResource($file);
    }
}   
