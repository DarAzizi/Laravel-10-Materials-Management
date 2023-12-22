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
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name');
            $table->string('ItemCode');
            $table->text('Description');
            $table->integer('Quantity');
            $table->unsignedBigInteger('equipment_code_id');
            $table->unsignedBigInteger('jet_position_id');
            $table->unsignedBigInteger('nature_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
