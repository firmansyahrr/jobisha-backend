<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateUpdateWorkExperienceRequest extends FormRequest
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
            'id' => ['nullable', 'exists:candidate_work_experiences,id'],
            'company_name' => ['required', 'max:255'],
            'job_title' => ['required', 'max:255'],
            'description' => ['nullable', 'max:1000'],
            'salary_range_id' => ['required', 'exists:application_parameters,id'],
            'is_till_current' => ['boolean'],
            'start_of_work' => ['required', 'date_format:Y-m'],
            'end_of_work' => ['nullable', 'required_if:is_till_current,false', 'date_format:Y-m'],
            'career_level_id' => ['required', 'exists:application_parameters,id'],
            'job_role_id' => ['required', 'exists:application_parameters,id'],
            'job_specialization_id' => ['required', 'exists:application_parameters,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $isTillCurrent = filter_var($this->is_till_current, FILTER_VALIDATE_BOOLEAN);
        $this->merge([
            'is_till_current' => $isTillCurrent
        ]);
    }
}
