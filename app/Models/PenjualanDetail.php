<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanDetail extends Model
{
    protected $table = 't_penjualan_detail';

    protected $primaryKey = 'detail_id';

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($detail) {
            // Mencari data stok berdasarkan barang_id yang sedang ditransaksikan
            $stok = Stok::where('barang_id', $detail->barang_id)->first();

            if ($stok) {
                // Mengurangi jumlah stok berdasarkan kuantitas penjualan
                $stok->decrement('stok_jumlah', $detail->jumlah);
            }
        });
    }

    public function penjualan(): BelongsTo
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'penjualan_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'barang_id');
    }
}