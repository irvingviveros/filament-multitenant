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
        Schema::table('students', function (Blueprint $table) {
            // Create a virtual column named 'age' that calculate the age of the user with the birth_date field and the current date. It needs to return the age in number of years.
            $table->string('age')->virtualAs('TIMESTAMPDIFF(YEAR, birth_date, CURDATE())')->after('birth_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('age');
        });
    }
};
