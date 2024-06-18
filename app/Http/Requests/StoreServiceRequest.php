<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            "title"       => "required",
            "description" => "nullable|string",
            "create_at"   => "date",
            "update_at"   => "date",
            "desable_at"  => "date",
            "active_at"   => "date",
            "user_id"     => "date",
            "image"       => "nullable|image"

        ];
    }
}
