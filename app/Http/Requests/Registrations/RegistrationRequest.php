<?php

namespace App\Http\Requests\Registrations;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:5|confirmed',
            'company_name' => 'required|string|min:3|max:255',
            'company_address' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'company_website' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image',
            'outlet_name' => 'required|string|min:3|max:255',
            'outlet_address' => 'nullable|string|max:255',
            'outlet_phone' => 'nullable|string|max:20',
            'outlet_email' => 'nullable|email|max:255',
        ];
    }
}
