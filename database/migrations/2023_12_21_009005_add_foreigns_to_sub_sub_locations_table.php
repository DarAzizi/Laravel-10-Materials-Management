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
        Schema::table('sub_sub_locations', function (Blueprint $table) {
            $table
                ->foreign('sub_location_id')
                ->references('id')
                ->on('sub_locations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_sub_locations', function (Blueprint $table) {
            $table->dropForeign(['sub_location_id']);
        });
    }
};
