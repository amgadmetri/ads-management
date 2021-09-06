<?php

namespace App\Http\Requests\Tags;

use App\DTOs\CreateTagDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "unique:tags,name"],
        ];
    }

    public function getDTO(): CreateTagDTO
    {
        return CreateTagDTO::fromArray([
            "name" => $this->get('name')
        ]);
    }
}
