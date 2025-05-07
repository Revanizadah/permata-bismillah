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

        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id(); // Menambahkan ID sebagai primary key

            // Ubah tipe user_id menjadi unsignedBigInteger untuk kecocokan dengan id di tabel users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users'); // Foreign key ke users

            // Ubah tipe jenis_lapangan menjadi string, sesuai dengan lapangans
            $table->string('jenis_lapangan');
            $table->foreign('jenis_lapangan')->references('jenis_lapangan')->on('lapangans'); // Foreign key ke lapangans

            // Kolom no_hp bertipe string, pastikan ada indeks unik di users
            $table->string('no_hp');
            $table->foreign('no_hp')->references('no_hp')->on('users'); // Foreign key ke users

            // Ubah tipe pesanan_id menjadi unsignedBigInteger untuk kecocokan dengan id di tabel pesanans
            $table->unsignedBigInteger('pesanan_id');
            $table->foreign('pesanan_id')->references('id')->on('pesanans'); // Foreign key ke pesanans

            // Kolom bukti_pembayaran
            $table->string('bukti_pembayaran');

            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
