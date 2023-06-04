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
        Schema::create('appointment', function (Blueprint $table) {
            $table->string('appointment_id')->primary();
            $table->string('customer_phone');
            $table->string('henna_artist_phone');
            $table->date('date');
            $table->string('package');
            $table->integer('price');
            $table->string('status');
            $table->unique(['date', 'henna_artist_phone']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
