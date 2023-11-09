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
            $table->text('description')->nullable();
            $table->string('month_graduation', '15')->nullable();
            $table->string('year_graduation', '4')->nullable();

            $table->string('level_of_education')->nullable(true)->change();
            $table->string('year_from', 4)->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->dropColumn(['description']);
            $table->dropColumn(['month_graduation']);
            $table->dropColumn(['year_graduation']);

            $table->string('level_of_education')->nullable(true)->change();
            $table->string('year_from', 4)->nullable(true)->change();
        });
    }
};
