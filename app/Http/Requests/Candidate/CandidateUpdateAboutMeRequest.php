<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CandidateUpdateAboutMeRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'address' => ['nullable', 'max:500'],
            'province_id' => ['nullable', 'exists:provinces,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'place_of_birth' => ['nullable', 'max:100'],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'gender_id' => ['exists:application_parameters,id'],
            'phone_number' => ['string', 'max:15'],
            'about_me' => ['required', 'max:1000'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ];
    }

    

    protected function prepareForValidation(): void
    {
        $photo = $this->photo;
        if($photo == "null" || $photo == ""){
            $this->merge([
                'photo' => null
            ]);
        }
    }
}