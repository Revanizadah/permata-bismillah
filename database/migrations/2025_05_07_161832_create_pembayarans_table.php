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
            $table->foreign('user_id')->references('id')->on('users');
            $table->string("bukti_pembaran");
            $table->foreign('jenis_lapangan')->references('jenis_lapangan')->on('lapangans');
            $table->foreign('no_hp')->refrences('no_hp')->on('users');
            $table->foreign('pesanan_id')->references('id')->on('pesanans');
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
