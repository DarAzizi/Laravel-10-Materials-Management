<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JetPositionStoreRequest extends FormRequest
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
            'Position' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'jet_id' => ['required', 'exists:jets,id'],
        ];
    }
}
