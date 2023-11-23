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
        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->unsignedBigInteger('education_level_id')->nullable();
        });

        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->foreign('education_level_id')->references('id')->on('application_parameters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->dropForeign(['education_level_id']);
        });

        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->dropColumn('education_level_id');
        });
    }
};
