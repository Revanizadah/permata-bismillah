<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->decimal('harga_per_jam', 10, 2);
            $table->decimal('harga_weekend_per_jam', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapangans');
    }
};
