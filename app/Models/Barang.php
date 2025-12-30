<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'pemasok_id',
        'gambar_barang',
        'nama_barang',
        'deskripsi',
        'harga',
        'stok',
    ];

    protected function gambar()
    {
        return Attribute::make(
            get: fn ($gambar) => asset('storage/' . $gambar),
        );
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class,'pemasok_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class,'barang_id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(Transaksi::class,'barang_id');
    }
    public function barangKeluar()
    {
        return $this->hasMany(Transaksi::class,'barang_id');
    }
}
