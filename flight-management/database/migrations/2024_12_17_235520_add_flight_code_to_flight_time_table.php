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
        Schema::table('flight_time', function (Blueprint $table) {
            $table->string('flight_code')->nullable()->after('id'); // Thêm flight_code sau cột TK_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flight_time', function (Blueprint $table) {
            $table->dropColumn('flight_code'); // Xóa flight_code khi rollback
        });
    }
};
