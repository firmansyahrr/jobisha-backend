<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidate_work_experiences', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('candidate_id');
            $table->string('company_name');
            $table->string('job_title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('salary_range_id')->nullable();

            $table->string('start_of_month', '15')->nullable();
            $table->string('start_of_year', '4')->nullable();
            $table->string('end_of_month', '15')->nullable();
            $table->string('end_of_year', '4')->nullable();
            $table->boolean('is_till_current')->default(false);

            $table->unsignedBigInteger('career_level_id')->nullable();
            $table->unsignedBigInteger('job_role_id')->nullable();
            $table->unsignedBigInteger('job_specialization_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('modified_user_id')->nullable();
            $table->unsignedBigInteger('deleted_user_id')->nullable();
        });

        Schema::table('candidate_work_experiences', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('salary_range_id')->references('id')->on('application_parameters');
            $table->foreign('career_level_id')->references('id')->on('application_parameters');
            $table->foreign('job_role_id')->references('id')->on('job_roles');
            $table->foreign('job_specialization_id')->references('id')->on('job_specializations');

            $table->foreign('created_user_id')->references('id')->on('users');
            $table->foreign('modified_user_id')->references('id')->on('users');
            $table->foreign('deleted_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_work_experiences', function (Blueprint $table) {
            $table->dropForeign(['candidate_id']);
            $table->dropForeign(['salary_range_id']);
            $table->dropForeign(['career_level_id']);
            $table->dropForeign(['job_role_id']);
            $table->dropForeign(['job_specialization_id']);

            $table->dropForeign(['created_user_id']);
            $table->dropForeign(['modified_user_id']);
            $table->dropForeign(['deleted_user_id']);
        });


        Schema::dropIfExists('candidate_work_experiences');
    }
};
