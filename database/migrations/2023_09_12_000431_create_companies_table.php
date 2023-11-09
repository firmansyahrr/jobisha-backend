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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->text('description')->nullable();
            $table->string('phone_number')->nullable();

            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->text('address')->nullable();
            $table->string('zip_code')->nullable();

            $table->unsignedBigInteger('employee_size_id')->nullable();
            $table->unsignedBigInteger('company_industry_id')->nullable();

            $table->string('website')->nullable();
            $table->string('nib_no')->nullable();
            $table->text('nib_file')->nullable();
            $table->smallInteger('since_year')->nullable();

            $table->timestamps();
            $table->softDeletes();
            
            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('modified_user_id')->nullable();
            $table->unsignedBigInteger('deleted_user_id')->nullable();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('employee_size_id')->references('id')->on('application_parameters');
            $table->foreign('company_industry_id')->references('id')->on('application_parameters');
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
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['employee_size_id']);
            $table->dropForeign(['company_industry_id']);
            $table->dropForeign(['created_user_id']);
            $table->dropForeign(['modified_user_id']);
            $table->dropForeign(['deleted_user_id']);
        });

        Schema::dropIfExists('companies');
    }
};
