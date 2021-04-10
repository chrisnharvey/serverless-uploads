<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class UploadedFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'token' => Crypt::encryptString($this->verification_token),
            'name' => $this->name,
            'size' => $this->size,
            'mimetype' => $this->mimetype,
        ];
    }
}
