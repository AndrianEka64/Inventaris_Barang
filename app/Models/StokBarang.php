<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    protected $fillable = [
        'barang_id',
        'tanggal',
        'jumlah_masuk',
        'jumlah_keluar',
        'stok_akhir',
        'keterangan',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
