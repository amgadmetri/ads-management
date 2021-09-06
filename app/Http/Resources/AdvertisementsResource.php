<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementsResource extends JsonResource
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
            "id"          => $this->id,
            "title"       => $this->title,
            "description" => $this->description,
            "start_date"  => $this->start_date,
            "category"    => $this->category->name,
            "tags"        => TagsResource::collection($this->tags),
        ];
    }

}
