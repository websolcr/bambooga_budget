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
        Schema::create('amount_and_valid_date_of_income_sources', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('income_source_id')->constrained();
            $table->unsignedSmallInteger('amount');
            $table->date('valid_from');
            $table->date('valid_end')->nullable();
            $table->unsignedSmallInteger('payment_cycle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amount_and_valid_date_of_income_sources');
    }
};
