<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProfileRequest extends FormRequest
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

        $user = Auth::user();
        $request = request()->only(["username", "email"]);

        $rules = [
            "password"     => "nullable|string",
            "confirmation" => "nullable|string",
            "update_at"    => "nullable|date",
            "bio"          => "nullable|string",
            "about"        => "nullable|string",
            // "profile"      => "nullable|image",
            // "about_img"    => "nullable|image",
        ];

        if ($user->username !== $request["username"]) {
            $rules["username"] = "nullable|unique:users"; 
        }

        if ($user->email !== $request["email"]) {
            $rules["email"] = "nullable|unique:users"; 
        }

        return $rules;
    }


    public function messages(): array
    {
        return [
            "username.unique" => "Already exists",
        ];
    }
}
