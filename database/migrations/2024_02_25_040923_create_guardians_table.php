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

        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 200);
            $table->string('paternal_surname', 100);
            $table->string('maternal_surname', 100)->nullable();
            $table->string('student_relationship');
            $table->string('address', 255)->nullable();
            $table->string('street_number', 10)->nullable();
            $table->string('neighborhood', 100)->nullable();
            $table->string('between_streets', 200)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('personal_email')->nullable();
            $table->string('personal_phone')->nullable();
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('guardians');
    }
};
