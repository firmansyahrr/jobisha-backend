<?php

namespace Database\Seeders;

use App\Models\Candidate\Candidate;
use App\Models\User;
use Illuminate\Database\Seeder;

class SetCandidateRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereNotNull('candidate_id')->get();
        foreach ($users as $candidate) {
            $candidate->assignRole('candidate');
        }
    }
}