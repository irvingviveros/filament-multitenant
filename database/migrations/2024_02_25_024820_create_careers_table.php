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

        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('enrollment', 100)->nullable();
            $table->string('description', 255)->nullable();
            $table->date('opening_date')->nullable();
            $table->string('status')->default('Activo');
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->foreignId('team_id')->nullable()->constrained();
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
        Schema::dropIfExists('careers');
    }
};
