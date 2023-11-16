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
            'work_experiences' => ['required', 'min:1'],
            'work_experiences.*.id' => ['nullable', 'exists:candidate_work_experiences,id'],
            'work_experiences.*.company_name' => ['required', 'max:255'],
            'work_experiences.*.job_title' => ['required', 'max:255'],
            'work_experiences.*.description' => ['nullable', 'max:1000'],
            'work_experiences.*.salary_range_id' => ['required', 'exists:application_parameters,id'],
            'work_experiences.*.start_of_month' => ['required', 'date_format:m'],
            'work_experiences.*.start_of_year' => ['required', 'date_format:Y'],
            'work_experiences.*.end_of_month' => ['required', 'date_format:m'],
            'work_experiences.*.end_of_year' => ['required', 'date_format:Y'],
            'work_experiences.*.is_till_current' => ['boolean'],
            'work_experiences.*.career_level_id' => ['required', 'exists:application_parameters,id'],
            'work_experiences.*.job_role_id' => ['required', 'exists:application_parameters,id'],
            'work_experiences.*.job_specialization_id' => ['required', 'exists:application_parameters,id'],
        ];
    }
}
