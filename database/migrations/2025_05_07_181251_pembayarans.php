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
            $table->string('kode_transaksi', 20)->unique();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->dateTime('tanggal');
            $table->decimal('jumlah', 10, 2);
            $table->string('metode', 50);
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status', 20)->default('Pending');
            $table->text('catatan')->nullable();
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
