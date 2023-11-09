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
        Schema::create('job_preference', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('preference_id');

            $table->timestamps();
            $table->softDeletes();
            
            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('modified_user_id')->nullable();
            $table->unsignedBigInteger('deleted_user_id')->nullable();
        });

        Schema::table('job_preference', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('preference_id')->references('id')->on('application_parameters');
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
        Schema::table('job_preference', function (Blueprint $table) {
            $table->dropForeign(['created_user_id']);
            $table->dropForeign(['modified_user_id']);
            $table->dropForeign(['deleted_user_id']);
        });

        Schema::dropIfExists('job_preference');
    }
};
