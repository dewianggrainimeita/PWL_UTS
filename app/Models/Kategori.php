<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'm_kategori';

    protected $primaryKey = 'kategori_id';

    protected $guarded = [];

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'kategori_id', 'kategori_id');
    }
}
