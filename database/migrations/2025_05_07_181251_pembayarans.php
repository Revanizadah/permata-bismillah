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
            $table->foreignId('pesanan_id')->constrained('pesanans');
            $table->string('kode_pembayaran')->unique(); // Kode unik untuk setiap transaksi
            $table->string('metode_pembayaran')->nullable();
            $table->string('status_pembayaran')->default('unpaid'); // 'unpaid', 'paid', 'expired'
            $table->dateTime('expired_at'); // Batas waktu pembayaran
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
