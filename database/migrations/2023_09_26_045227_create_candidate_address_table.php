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
        Schema::create('candidate_address', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->unsignedBigInteger('candidate_id');
            $table->text('address');

            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('modified_user_id')->nullable();
            $table->unsignedBigInteger('deleted_user_id')->nullable();
        });

        Schema::table('candidate_address', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('candidates');

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('city_id')->references('id')->on('cities');

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
        Schema::table('candidate_address', function (Blueprint $table) {
            $table->dropForeign(['candidate_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['province_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['created_user_id']);
            $table->dropForeign(['modified_user_id']);
            $table->dropForeign(['deleted_user_id']);
        });

        Schema::dropIfExists('candidate_address');
    }
};
