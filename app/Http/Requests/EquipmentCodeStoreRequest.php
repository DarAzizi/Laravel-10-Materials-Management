<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentCodeStoreRequest extends FormRequest
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
            'Description' => ['required', 'max:255', 'string'],
            'Drawing' => ['required', 'max:255', 'string'],
            'jet_position_id' => ['required', 'exists:jet_positions,id'],
        ];
    }
}
