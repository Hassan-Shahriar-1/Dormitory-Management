<?php

namespace App\Http\Requests;

use App\Traits\SanitizeInput;
use Illuminate\Foundation\Http\FormRequest;

class StudentDormitoryRequest extends FormRequest
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
            'id' => 'sometimes|nullable|exists:student_dormitories,id',
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'address' => 'required|string|max:60',
            'room_id' => 'required|uuid|exists:rooms,id',
            'status' => 'sometimes|nullable|in:0,1'
        ];
    }
}
