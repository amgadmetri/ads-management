<?php

namespace App\Http\Requests\Advertisements;

use App\DTOs\FilterAdvertisementDTO;
use Illuminate\Foundation\Http\FormRequest;

class FilterAdvertisementsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "tag"           => ['sometimes', 'string'],
            "category"      => ['sometimes', 'string'],
            "advertiser_id" => ['required', 'integer', 'min:1'],
        ];
    }
    
    public function getDTO(): FilterAdvertisementDTO
    {
        return FilterAdvertisementDTO::fromArray([
            "tag"           => $this->get('tag'),
            "category"      => $this->get('category'),
            "advertiser_id" => $this->get('advertiser_id')
        ]);
    }
}
