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
        Schema::create('candidate_profile_completeness', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('candidate_id');
            $table->string('activity'); // create_account, profile_completeness, work_experience, education, skill
            $table->string('label');
            $table->boolean('is_complete')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('modified_user_id')->nullable();
            $table->unsignedBigInteger('deleted_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_profile_completeness');
    }
};
