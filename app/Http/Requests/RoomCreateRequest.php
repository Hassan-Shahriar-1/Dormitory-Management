<?php

namespace App\Http\Requests;

use App\Traits\SanitizeInput;
use Illuminate\Foundation\Http\FormRequest;

class RoomCreateRequest extends FormRequest
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
            'id' => 'sometimes|nullable|exists:rooms,id',
            'room_type_id' => 'required|exists:room_types,id',
            'dormitory_id' => 'required|exists:dormitories,id',
            'description' => 'required|string|max:255',
            'room_number' => 'required|string|max:15',
            'number_of_beds' => 'required|integer|min:1',
            'status' => 'nullable|integer|in:0,1'
        ];
    }
}
