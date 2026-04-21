<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id');
            $table->foreignId('supplier_id')->references('supplier_id')->on('m_supplier')->cascadeOnDelete();
            $table->foreignId('barang_id')->references('barang_id')->on('m_barang')->cascadeOnDelete();
            $table->foreignId('user_id')->references('user_id')->on('m_user')->cascadeOnDelete();
            $table->dateTime('stok_tanggal');
            $table->integer('stok_jumlah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};
