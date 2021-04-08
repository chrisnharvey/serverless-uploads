<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UploadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $file = $this->route('file');

        try {
            return $file->exists && Crypt::decryptString($this->token) === $file->id;
        } catch (DecryptException) {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $file = $this->route('file');

        $fileRules = [
            'required'
        ];

        if ($file->min_size !== null) {
            $fileRules[] = "min:{$file->min_size}";
        }

        if ($file->max_size !== null) {
            $fileRules[] = "max:{$file->max_size}";
        }

        if ($file->types !== null) {
            $types = implode(',', $file->types);
            $fileRules[] = "mimes:{$types}";
        }

        return [
            'token' => ['required'],
            'file' => $fileRules
        ];
    }
}
