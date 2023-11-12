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
        Schema::create('candidate_jobs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('job_id');
            $table->string('type', 20);
            $table->timestamp('action_date')->useCurrent();
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('modified_user_id')->nullable();
            $table->unsignedBigInteger('deleted_user_id')->nullable();
        });

        Schema::table('candidate_jobs', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('job_id')->references('id')->on('jobs');

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
        Schema::table('candidate_jobs', function (Blueprint $table) {
            $table->dropForeign(['candidate_id']);
            $table->dropForeign(['job_id']);
            $table->dropForeign(['created_user_id']);
            $table->dropForeign(['modified_user_id']);
            $table->dropForeign(['deleted_user_id']);
        });

        Schema::dropIfExists('candidate_jobs');
    }
};
