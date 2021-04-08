<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateFileRequest extends FormRequest
{
    public function authorize(Request $request): bool
    {
        return $request->user()?->tokenCan('create') === true;
    }

    public function rules(): array
    {
        return [
            'types' => ['nullable', 'array'],
            'minSize' => ['nullable', 'integer'],
            'maxSize' => ['nullable', 'integer'],
            'linkExpires' => ['required', 'integer', 'min:60', 'max:86400'],
            'fileExpires' => ['required', 'integer', 'min:3600', 'max:604800'],
        ];
    }
}
