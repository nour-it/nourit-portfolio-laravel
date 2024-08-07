<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required',
            'category_id' => "required|integer",
            'add_at'      => 'date|nullable',
            'create_at'   => 'date|nullable',
            'end_at'      => 'date|nullable',
            'delete_at'   => 'date|nullable',
            'description' => 'string|nullable',
            "skill_id"    => "integer|nullable",
        ];
    }
}
