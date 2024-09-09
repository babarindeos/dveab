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
        Schema::create('segment_organs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('segment_id');
            $table->foreign('segment_id')->references('id')->on('segments')->onDelete('cascade');
            $table->bigInteger('organ_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segment_organs');
    }
};
