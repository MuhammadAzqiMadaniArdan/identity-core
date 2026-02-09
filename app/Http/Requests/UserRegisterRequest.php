<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            "first_name" => "required|string|regex:/^[^<>]*$/|min:3|max:255",
            "last_name" => "sometimes|string|nullable|max:255",
            "email" => "required|email|unique:users,email|max:255",
            "password" => "required|password|confirmed|min:8|max:255"
        ];
    }

    public function messages()
    {
        return [
            "*.regex" => 'Tidak boleh berisi karakter "<" dan ">"'
        ];
    }
}
