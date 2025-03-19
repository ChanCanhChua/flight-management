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
        Schema::create('transit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airport_id')->constrained('airports');
            $table->foreignId('flight_id')->constrained('flights');
            $table->integer('transit_order');
            $table->text('transit_note')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit');
    }
};
