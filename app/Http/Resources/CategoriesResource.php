<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"   => $this->id,
            "name" => $this->name,
        ];
    }

}
