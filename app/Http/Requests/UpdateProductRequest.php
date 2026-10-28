<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_code' => ['sometimes', 'string', 'max:50', Rule::unique('products', 'product_code')->ignore($this->route('product'))],
            'product_name' => ['sometimes', 'string', 'max:255'],
            'product_type' => ['sometimes', Rule::in(['fermented', 'non_fermented'])],
            'grade' => ['sometimes', Rule::in(['A', 'B', 'C'])],
            'description' => ['sometimes', 'nullable', 'string'],
            'price_per_kg' => ['sometimes', 'numeric', 'min:0'],
            'image_url' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
