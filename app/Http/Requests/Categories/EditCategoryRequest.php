<?php

namespace App\Http\Requests\Categories;

use App\DTOs\EditCategoryDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        $category_id = request()->segment(3);
        return [
            "name" => ["required", "string", Rule::unique('categories')->ignore($category_id, 'id')],
        ];
    }

    public function getDTO(): EditCategoryDTO
    {
        return EditCategoryDTO::fromArray([
            "name" => $this->get('name')
        ]);
    }
}
