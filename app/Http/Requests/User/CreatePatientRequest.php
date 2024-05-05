<?php

namespace App\Http\Requests\User;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|digits:10',
            'address' => 'required|string|max:255',
            'uploads' => 'nullable|file|mimetypes:application/pdf,image/jpeg,image/png|max:2048',
            'time' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ];
    }

    public function messages()
    {
        return [
            'uploads.mimetypes' => 'Only PDF, JPEG, and PNG files are allowed.',
            'uploads.max' => 'The uploaded file must not exceed 2MB.',
        ];
    }


}
