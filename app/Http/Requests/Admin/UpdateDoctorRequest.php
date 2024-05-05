<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'qualification' => 'required|array|min:1',
            'image' => 'array|min:1',
            'image.*' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'phone' => 'required|digits:10',
            'specializations' => 'required|array|min:1',
            'specializations.*' => 'exists:specializations,id',
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Doctor Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'qualification.required' => 'At least one qualification is required',
            'qualification.array' => 'Qualifications must be provided as an array',
            'qualification.min' => 'At least one valid qualification is required',
            'qualification.*.in' => 'Invalid qualification. Valid qualifications are: MBBCh, MBChB, MBBS, LRCP, BSc, MD, and PhD',
            'image.required' => 'At least one image is required',
            'image.array' => 'Images must be provided as an array',
            'image.min' => 'At least one image is required',
            'image.*.required' => 'An image file is required',
            'image.*.mimes' => 'Only JPG, JPEG, PNG, and GIF image formats are supported',
            'image.*.max' => 'The image size must not exceed 2048 KB',
            'phone.required' => 'Phone number is required',
            'specializations.required' => 'At least one specialization is required',
            'specializations.array' => 'Specializations must be provided as an array',
            'specializations.min' => 'At least one specialization is required',
            'specializations.*.exists' => 'One or more selected specializations are invalid',
        ];
    }
}
