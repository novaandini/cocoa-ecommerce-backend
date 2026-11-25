<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQualityCheckRequest extends FormRequest
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
            'batch_id' => ['required', 'integer', Rule::exists('batches', 'id')],
            'checked_by' => ['sometimes', 'integer', Rule::exists('users', 'id')],
            'moisture_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'fermentation_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'defective_beans_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'quality_result' => ['sometimes', Rule::in(['passed', 'failed', 'pending'])],
            'notes' => ['nullable', 'string'],
            'checked_at' => ['nullable', 'date'],
        ];
    }
}
