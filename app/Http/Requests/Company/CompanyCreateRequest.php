<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:companies,email'],
            'website' => ['nullable', 'string'],
            'phone_number' => ['string', 'nullable'],
            'since_year' => ['required', 'date_format:Y'],
            'province_id' => ['nullable', 'exists:provinces,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'address' => ['required',],
            'zip_code' => ['nullable'],
            'employee_size_id' => ['exists:application_parameters,id'],
            'company_industry_id' => ['exists:application_parameters,id'],
            'description' => ['string', 'nullable'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ];
    }
}
