<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('equipment_codes', function (Blueprint $table) {
            $table
                ->foreign('jet_position_id')
                ->references('id')
                ->on('jet_positions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment_codes', function (Blueprint $table) {
            $table->dropForeign(['jet_position_id']);
        });
    }
};
