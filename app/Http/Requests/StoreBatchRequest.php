<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBatchRequest extends FormRequest
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
            'product_id' => ['required', 'integer', Rule::exists('products', 'id')],
            'batch_code' => ['required', 'string', 'max:100', Rule::unique('batches', 'batch_code')],
            'origin' => ['nullable', 'string', 'max:255'],
            'harvest_date' => ['nullable', 'date'],
            'production_date' => ['nullable', 'date'],
            'initial_quantity_kg' => ['required', 'numeric', 'min:0'],
            'available_quantity_kg' => ['sometimes', 'numeric', 'min:0', 'lte:initial_quantity_kg'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
