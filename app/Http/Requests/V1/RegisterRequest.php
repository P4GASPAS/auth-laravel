<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'username' => ['required'],
            'firstName' => ['required'],
            'middleName' => ['sometimes', 'nullable'],
            'lastName' => ['sometimes', 'nullable'],
            'nickname' => ['sometimes', 'nullable'],

            'birthdate' => ['sometimes', 'nullable'],
            'location' => ['sometimes', 'nullable'],
            'gender' => ['sometimes', 'nullable', Rule::in(['male', 'female'])],
            'contact' => ['sometimes', 'nullable'],

            'email' => ['sometimes', 'nullable'],

            'password' => ['required', 'min:6', 'required_with:passwordConfirmation'],
            'passwordConfirmation' => ['required', 'same:password'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
        ]);
    }
}
