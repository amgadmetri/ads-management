<?php

namespace App\Http\Requests\Tags;

use App\DTOs\EditTagDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTagRequest extends FormRequest
{
    public function rules(): array
    {
        $tag_id = request()->segment(3);
        return [
            "name" => ["required", "string", Rule::unique('tags')->ignore($tag_id, 'id')],
        ];
    }

    public function getDTO(): EditTagDTO
    {
        return EditTagDTO::fromArray([
            "name" => $this->get('name')
        ]);
    }
}
