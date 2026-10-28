<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'product_code' => ['required', 'string', 'max:50', Rule::unique('products', 'product_code')],
            'product_name' => ['required', 'string', 'max:255'],
            'product_type' => ['required', Rule::in(['fermented', 'non_fermented'])],
            'grade' => ['required', Rule::in(['A', 'B', 'C'])],
            'description' => ['nullable', 'string'],
            'price_per_kg' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
