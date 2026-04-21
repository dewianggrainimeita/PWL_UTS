<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id('detail_id');
            $table->foreignId('penjualan_id')->references('penjualan_id')->on('t_penjualan')->cascadeOnDelete();
            $table->foreignId('barang_id')->references('barang_id')->on('m_barang')->cascadeOnDelete();
            $table->unsignedInteger('harga');
            $table->unsignedInteger('jumlah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_penjualan_detail');
    }
};
