<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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

        // Validate When Creating New Product
        if ($this->getMethod() === 'POST') {
            return [
                'name' => 'required|string|max:255|unique:products',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'is_active' => 'required|in:0,1'
            ];
        }
        // Validate When Updating New Product
        return [
            'name' => 'unique:products,name,' . $this->route('product') . '|nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'nullable|in:0,1'
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
