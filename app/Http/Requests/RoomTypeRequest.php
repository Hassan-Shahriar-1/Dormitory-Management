<?php

namespace App\Http\Requests;

use App\Traits\SanitizeInput;
use Illuminate\Foundation\Http\FormRequest;

class RoomTypeRequest extends FormRequest
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
            'id' => 'sometimes|nullable|exists:room_types,id',
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:0,1',
            'fee' => 'required|numeric',
            'description' => 'required|string|max:255'
        ];
    }
}
