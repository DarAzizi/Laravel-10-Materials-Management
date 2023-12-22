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
        Schema::table('jet_positions', function (Blueprint $table) {
            $table
                ->foreign('jet_id')
                ->references('id')
                ->on('jets')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jet_positions', function (Blueprint $table) {
            $table->dropForeign(['jet_id']);
        });
    }
};
