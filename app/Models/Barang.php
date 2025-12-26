<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
    ];
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class,'barang_id');
    }
}
