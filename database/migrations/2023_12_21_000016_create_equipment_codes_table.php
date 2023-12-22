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
        Schema::create('equipment_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name');
            $table->text('Description');
            $table->string('Drawing');
            $table->unsignedBigInteger('jet_position_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_codes');
    }
};
