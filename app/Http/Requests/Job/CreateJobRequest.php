<?php

namespace App\Http\Requests\Job;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
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
            'title' => ['required', 'max:150'],
            'job_type_id' => ['exists:application_parameters,id'],
            'company_id' => ['required', 'exists:companies,id'],
            'job_description' => ['required'],
            'requirement' => ['required'],
            'responsibilities' => ['required'],
            'benefit' => ['required'],
            'qualification' => ['required'],
            'year_of_experience' => ['numeric'],
            'min_sallary' => ['numeric'],
            'max_sallary' => ['numeric'],
            'career_level_id' => ['exists:application_parameters,id'],
            'job_role_id' => ['exists:job_roles,id'],
            'job_specialization_id' => ['exists:job_specializations,id'],
            'valid_until' => ['required', 'date_format:Y-m-d', 'after:today'],

            'job_preferences' => ['array', 'min:1', 'required', 'exists:application_parameters,id'],
            'job_locations' => ['array', 'min:1', 'required', 'exists:cities,id'],
        ];
    }
}
