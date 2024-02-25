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

        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('sheet')->nullable();
            $table->string('payment_method');
            $table->string('payment_concept');
            $table->decimal('amount', 10, 2);
            $table->string('amount_text', 255)->nullable();
            $table->dateTime('payment_date');
            $table->text('note')->nullable();
            $table->integer('create_by')->nullable();
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
        Schema::dropIfExists('receipts');
    }
};
