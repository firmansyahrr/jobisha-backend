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
        Schema::table('candidates', function (Blueprint $table) {
            $table->unsignedBigInteger('gender_id')->nullable();
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->foreign('gender_id')->references('id')->on('application_parameters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropForeign(['gender_id']);
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->string('gender')->nullable();
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('gender_id');
        });
    }
};
