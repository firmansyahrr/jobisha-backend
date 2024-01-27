<?php

namespace App\Http\Requests\Candidate;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateCandidateRequest extends FormRequest
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
            'password' => ['required', 'string', 'confirmed', Password::min('8')->mixedCase()->numbers()->symbols()],
            'phone_number' => ['string', 'nullable', 'max:18'],
            'place_of_birth' => ['string', 'nullable', 'max:100'],
            'gender' => ['nullable', 'exists:application_parameters,id'],

            'address' => ['nullable', 'max:500'],
            'province_id' => ['nullable', 'exists:provinces,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'gender_id' => ['exists:application_parameters,id'],

            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $birthday = $this->birthday;
        $formatted = Carbon::createFromFormat('d M, Y', $birthday)->toDateString();

        $this->merge([
            'birthday' => $formatted
        ]);
    }
}
