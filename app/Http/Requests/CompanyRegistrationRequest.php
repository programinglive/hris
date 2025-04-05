<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Company fields
            'name' => 'required|string|max:255|unique:companies,name',
            'code' => 'required|string|max:20|unique:companies,code',
            'legal_name' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:50',
            'registration_number' => 'nullable|string|max:50',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|file|image|max:2048',
            'description' => 'nullable|string',

            // Administrator fields
            'administrator.name' => 'required|string|max:255',
            'administrator.email' => 'required|email|unique:users,email',
            'administrator.password' => 'required|min:8|confirmed',
            'administrator.password_confirmation' => 'required|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'administrator.password.confirmed' => 'The password confirmation does not match.',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if ($this->hasFile('logo')) {
                $validator->passesIf(function () {
                    return $this->file('logo')->isValid();
                });
            }
        });
    }
}
