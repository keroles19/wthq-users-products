<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users',
            'password'  => 'required|string|max:255|confirmed',
            'avatar'    => 'nullable|file|max:1024|mimes:jpg,jpeg,png',
            'type'      => 'string|max:255|in:normal,gold,silver',
            'is_active' => 'in:1,0',
        ];
    }


    /**
     * Custom Validation Response
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'code' => 1422,
            'hint' => 'Unprocessable Entity',
            'errors' => $validator->errors(),
        ], 422));
    }
}
