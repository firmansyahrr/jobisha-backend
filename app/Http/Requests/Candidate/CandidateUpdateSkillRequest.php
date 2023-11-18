<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateUpdateSkillRequest extends FormRequest
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
            'skills' => ['required', 'min:1'],
            'skills.*.id' => ['nullable', 'exists:candidate_skills,id'],
            'skills.*.skill' => ['required', 'max:255'],
            'skills.*.skill_level_id' => ['required', 'exists:application_parameters,id']
        ];
    }
}
