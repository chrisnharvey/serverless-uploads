<?php

use App\Http\Controllers\CreateFileController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/files', CreateFileController::class);

    Route::get('/files/{file}/download', DownloadFileController::class);
});

Route::post('/files/{file}', UploadFileController::class);