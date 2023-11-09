<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CandidateUpdateEducationRequest extends FormRequest
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
            'educations' => ['required', 'min:1'],
            'educations.*.id' => ['nullable', 'exists:candidate_educations,id'],
            'educations.*.name' => ['required', 'max:255'],
            'educations.*.level_of_education' => ['required', 'max:255'],
            'educations.*.description' => ['max:1000'],
            'educations.*.month_graduation' => ['required', 'date_format:mm'],
            'educations.*.year_graduation' => ['required', 'date_format:Y'],
        ];
    }
}
