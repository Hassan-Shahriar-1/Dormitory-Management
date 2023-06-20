<?php

namespace App\Http\Requests;

use App\Traits\SanitizeInput;
use Illuminate\Foundation\Http\FormRequest;

class DormitoryRequest extends FormRequest
{
    use SanitizeInput;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'sometimes|nullable|exists:dormitories,id',
            'name' => 'required|string|max:60',
            'type' => 'required|string|in:boys,girls',
            'address' => 'nullable|string|max:255'
        ];
    }
}
