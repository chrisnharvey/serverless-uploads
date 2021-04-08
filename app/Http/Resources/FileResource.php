<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class FileResource extends JsonResource
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
            'token' => Crypt::encryptString($this->id),
            'name' => $this->name,
            'size' => $this->size ? (int) $this->size : null,
            'mimetype' => $this->mimetype,
            'types' => $this->types,
            'minSize' => $this->min_size ? (int) $this->min_size : null,
            'maxSize' => $this->max_size ? (int) $this->max_size : null,
            'linkExpires' => $this->link_expires,
            'fileExpires' => $this->file_expires
        ];
    }
}
