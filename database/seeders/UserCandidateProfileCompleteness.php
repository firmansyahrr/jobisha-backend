<?php

namespace Database\Seeders;

use App\Models\Candidate\Candidate;
use App\Models\Candidate\CandidateEducation;
use App\Models\Candidate\CandidateProfileCompleteness;
use App\Models\Candidate\CandidateSkill;
use App\Models\Candidate\CandidateWorkExperience;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserCandidateProfileCompleteness extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $completeness_point = [
            [
                'activity' => 'create_account',
                'label' => 'Create Account',
                'status' => true
            ],
            [
                'activity' => 'profile_completeness',
                'label' => 'Complete Basic Info',
                'status' => false
            ],
            [
                'activity' => 'work_experience',
                'label' => 'Add Work Experience',
                'status' => false
            ],
            [
                'activity' => 'education',
                'label' => 'Add Education',
                'status' => false
            ],
            [
                'activity' => 'skill',
                'label' => 'Add Skill',
                'status' => false
            ],
        ];

        $candidates = Candidate::all();
        foreach ($candidates as $candidate) {
            foreach ($completeness_point as $complete) {
                $activity = $complete['activity'];
                $status = $complete['status'];
                $candidateProfileCompleteness = CandidateProfileCompleteness::where('candidate_id', $candidate->id)->where('activity', $activity)->get()->first();
                if (!$candidateProfileCompleteness) {
                    if ($activity == 'profile_completeness') {
                        $status = ($candidate->place_of_birth != null) ? true : false;
                    } else if ($activity == 'work_experience') {
                        $status = (CandidateWorkExperience::where('candidate_id', $candidate->id)->count() > 0) ? true : false;
                    } else if ($activity == 'education') {
                        $status = (CandidateEducation::where('candidate_id', $candidate->id)->count() > 0) ? true : false;
                    } else if ($activity == 'skill') {
                        $status = (CandidateSkill::where('candidate_id', $candidate->id)->count() > 0) ? true : false;
                    }

                    CandidateProfileCompleteness::create(['candidate_id' => $candidate->id, 'activity' => $complete['activity'], 'label' => $complete['label'], 'is_complete' => $status]);
                }
            }
        }
    }
}