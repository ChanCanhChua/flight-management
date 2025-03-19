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
        Schema::create('retrictions', function (Blueprint $table) {
            $table->id();
            $table->integer('min_duration')->default(0);
            $table->integer('max_duration')->default(0);
            $table->integer('min_transit_time')->default(0);
            $table->integer('max_transit_time')->default(0);
            $table->timestamp('latest_booking_time')->nullable();;
            $table->timestamp('latest_canceling_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retrictions');
    }
};
