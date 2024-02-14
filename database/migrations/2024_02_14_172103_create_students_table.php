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
        Schema::disableForeignKeyConstraints();

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('national_id')->unique()->nullable()->default('N/A');
            $table->string('enrollment')->nullable();
            $table->string('admission_no')->nullable();
            $table->date('admission_date')->nullable();
            $table->string('payment_reference')->nullable()->default('N/A');
            $table->string('first_name', 200);
            $table->string('paternal_surname', 100);
            $table->string('maternal_surname', 100)->nullable();
            $table->date('birth_date');
            $table->string('occupation', 100)->nullable()->default('N/A');
            $table->string('nationality', 100)->nullable()->default('Mexicana');
            $table->string('personal_email', 255)->unique()->nullable()->default('N/A');
            $table->string('personal_phone')->unique()->nullable()->default('N/A');
            $table->string('marital_status')->nullable()->default('N/A');
            $table->string('address', 255)->nullable();
            $table->string('street_number', 10)->nullable();
            $table->string('interior_number', 10)->nullable();
            $table->string('neighborhood', 100)->nullable();
            $table->string('between_streets', 200)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('inscription_date', 100)->nullable();
            $table->string('sex', 20)->nullable();
            $table->string('gender', 50)->nullable();
            $table->string('blood_group', 15)->nullable();
            $table->string('allergies', 250)->nullable();
            $table->string('ailments', 250)->nullable();
            $table->string('guardian_relationship', 250)->default('N/A');
            $table->tinyInteger('status')->default(1);
            $table->foreignId('team_id')->constrained();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('guardian_id')->nullable()->constrained();
            $table->integer('scholarship_id')->nullable();
            $table->integer('career_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
