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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('job_type_id');

            $table->string('title');
            $table->text('job_description')->nullable();
            $table->text('requirement')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('benefit')->nullable();
            $table->text('qualification')->nullable();
            $table->smallInteger('year_of_experience')->nullable();
            $table->decimal('min_sallary', 12, 2, true)->default(0);
            $table->decimal('max_sallary', 12, 2, true)->default(0);

            $table->unsignedBigInteger('career_level_id');
            $table->unsignedBigInteger('job_role_id');
            $table->unsignedBigInteger('job_specialization_id');

            $table->date('valid_until')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('modified_user_id')->nullable();
            $table->unsignedBigInteger('deleted_user_id')->nullable();
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('job_type_id')->references('id')->on('application_parameters');
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
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['job_type_id']);
            $table->dropForeign(['career_level_id']);
            $table->dropForeign(['job_role_id']);
            $table->dropForeign(['job_specialization_id']);
            $table->dropForeign(['created_user_id']);
            $table->dropForeign(['modified_user_id']);
            $table->dropForeign(['deleted_user_id']);
        });
        Schema::dropIfExists('jobs');
    }
};
