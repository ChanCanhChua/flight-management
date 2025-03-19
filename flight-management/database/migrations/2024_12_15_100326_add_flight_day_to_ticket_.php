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
        Schema::create('passenger', function (Blueprint $table) {
            $table->id();
            $table->string('passenger_name');
            $table->bigInteger('passenger_id_card');
            $table->bigInteger('passenger_tel');
            $table->string('passenger_email');
            $table->bigInteger('passenger_id_card')->nullable()->change();
            $table->timestamps();

        });
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            // $table->foreignId('class_id')->constrained('class')->onDelete('cascade');
            $table->foreignId('flight_time_id')->constrained('flight_time')->onDelete('cascade');
            $table->decimal('amount_booked', 10, 2);
            $table->integer('quantity')->default(1);

            $table->date('flight_date');
            $table->foreignId('passenger_id')->constrained('passenger');
            $table->timestamps();
        });

    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket', function (Blueprint $table) {
            $table->dropIfExists('flight_date');
            $table->dropIfExists('passenger_id');
        });
        Schema::table('passenger', function (Blueprint $table) {
            $table->dropIfExists('passenger_email');
        });
    }
};
