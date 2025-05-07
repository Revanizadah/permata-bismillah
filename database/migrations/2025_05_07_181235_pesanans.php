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
            $table->id(); // default BIGINT UNSIGNED
            $table->unsignedBigInteger('user_id'); // Pastikan ini sesuai dengan tipe kolom id di tabel users
            $table->string('jenis_lapangan'); // Pastikan tipe data ini sama dengan di tabel lapangans
            $table->string('no_hp'); // Tipe data yang sama dengan no_hp di tabel users
            $table->date('tanggal_pesan');
            $table->time('jam_pesan');
            $table->string('status')->default('pending');
            $table->string('catatan');
            $table->timestamps();

            // Menambahkan foreign key constraints setelah kolom dibuat
            $table->foreign('user_id')->references('id')->on('users'); // Menghubungkan user_id dengan id di tabel users
            $table->foreign('jenis_lapangan')->references('jenis_lapangan')->on('lapangans'); // Menghubungkan jenis_lapangan dengan lapangans
            $table->foreign('no_hp')->references('no_hp')->on('users'); // Menghubungkan no_hp dengan no_hp di tabel users
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
