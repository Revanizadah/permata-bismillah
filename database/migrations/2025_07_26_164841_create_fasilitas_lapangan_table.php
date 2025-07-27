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
        Schema::create('fasilitas_lapangan', function (Blueprint $table) {
        $table->foreignId('lapangan_id')->constrained('lapangans')->onDelete('cascade');
        $table->foreignId('fasilitas_id')->constrained('fasilitas')->onDelete('cascade');
        $table->primary(['lapangan_id', 'fasilitas_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_lapangan');
    }
};
