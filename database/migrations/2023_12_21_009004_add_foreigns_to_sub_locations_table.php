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
        Schema::table('sub_locations', function (Blueprint $table) {
            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_locations', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
        });
    }
};
