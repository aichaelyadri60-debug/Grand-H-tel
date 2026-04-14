<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class receReservationsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'nullable|exists:users,id',

            'manual_name' => 'nullable|string|max:255|required_without:client_id',
            'manual_email' => 'nullable|email',
            'manual_phone' => 'nullable|string|max:20',

            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ];
    }
}
