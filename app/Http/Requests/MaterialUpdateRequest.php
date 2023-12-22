<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'Name' => ['required', 'max:255', 'string'],
            'ItemCode' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'Quantity' => ['required', 'numeric'],
            'jet_position_id' => ['required', 'exists:jet_positions,id'],
            'equipment_code_id' => ['required', 'exists:equipment_codes,id'],
            'nature_id' => ['required', 'exists:natures,id'],
        ];
    }
}
