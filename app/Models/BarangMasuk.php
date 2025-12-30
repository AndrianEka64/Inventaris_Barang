<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $fillable = [
        'pemasok_id',
        'barang_id',
        'qty',
        'harga_beli',
        'tanggal_masuk'
    ];

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class,'pemasok_id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
