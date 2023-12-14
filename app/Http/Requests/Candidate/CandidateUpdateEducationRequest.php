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
            'id' => ['nullable', 'exists:candidate_educations,id'],
            'name' => ['required', 'max:255'],
            'education_level_id' => ['required', 'exists:application_parameters,id'],
            'description' => ['max:1000'],
            'is_till_current' => ['boolean'],
            'graduation_date' => ['nullable', 'required_if:is_till_current,false', 'date_format:Y-m'],
        ];
    }
}
