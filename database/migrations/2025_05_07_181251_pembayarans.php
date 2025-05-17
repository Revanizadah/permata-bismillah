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
            $table->id(); 
            $table->string('no_pesanan');
            $table->string('nama_pemesan');
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran')->default('pending');
            $table->string('jumlah_pembayaran');
            $table->string('bukti_pembayaran')->nullable(); 
            $table->string('catatan')->nullable(); 
            $table->timestamps(); 
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
