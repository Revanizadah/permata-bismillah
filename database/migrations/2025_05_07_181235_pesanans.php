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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('jenis_lapangan');
            $table->string('no_hp');
            $table->date('tanggal_pesan');
            $table->time('jam_pesan');
            $table->string('status')->default('pending');
            $table->string('catatan');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('jenis_lapangan')->references('jenis_lapangan')->on('lapangans');
            $table->foreign('no_hp')->references('no_hp')->on('users');     
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
