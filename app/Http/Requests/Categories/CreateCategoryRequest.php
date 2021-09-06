<?php

namespace App\Http\Requests\Categories;

use App\DTOs\CreateCategoryDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "unique:categories,name"],
        ];
    }

    public function getDTO(): CreateCategoryDTO
    {
        return CreateCategoryDTO::fromArray([
            "name" => $this->get('name')
        ]);
    }
}
