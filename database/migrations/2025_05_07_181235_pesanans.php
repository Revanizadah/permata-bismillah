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
            $table->string('nama_pemesan');
            $table->string('jenis_lapangan');
            $table->string('no_hp');
            $table->date('tanggal_pesan');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->time('jumlah_jam');
            $table->string('status')->default('pending');
            $table->integer('total_harga');
            $table->string('catatan');
            $table->timestamps();
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
