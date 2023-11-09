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
        Schema::create('candidate_educations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('candidate_id');
            $table->string('level_of_education');
            $table->string('name');
            $table->string('major')->nullable();
            $table->string('year_from', 4);
            $table->string('year_to', 4)->nullable();
            $table->boolean('is_till_current')->default(false);
            $table->decimal('gpa')->default(0.0);

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('modified_user_id')->nullable();
            $table->unsignedBigInteger('deleted_user_id')->nullable();
        });

        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('candidates');

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
        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->dropForeign(['candidate_id']);

            $table->dropForeign(['created_user_id']);
            $table->dropForeign(['modified_user_id']);
            $table->dropForeign(['deleted_user_id']);
        });

        Schema::dropIfExists('candidate_educations');
    }
};
