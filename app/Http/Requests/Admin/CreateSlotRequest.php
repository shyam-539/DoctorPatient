<?php
/**
 * Created By - Adithya Prasad
 * Date - 02/03/2024
*/

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateSlotRequest extends FormRequest
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
            'dates' => 'required',
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
            'dates.required' => 'Please select Dates',
        ];
    }
}
