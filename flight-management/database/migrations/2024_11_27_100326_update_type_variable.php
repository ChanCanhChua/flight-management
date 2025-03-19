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
        Schema::table('flights', function (Blueprint $table) {
            // $table->timestamp('created_at')->nullable();
            // $table->timestamp('updated_at')->nullable();
            $table->decimal('price', 10, 2)->nullable()->change();;
            $table->integer('total_seat')->nullable()->change();
        });
        Schema::table('flight_time', function (Blueprint $table) {
            $table->time('flight_time')->nullable()->change();
            $table->integer('x_pos')->nullable()->change();
            $table->integer('y_pos')->nullable()->change();
        });
        Schema::table('chair_booked', function (Blueprint $table) {
            $table->integer('x_pos')->nullable()->change();
            $table->integer('y_pos')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flights', function (Blueprint $table) {
//            $table->dropColumn('price');
//            $table->dropColumn('total_seat');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    
    }
};
