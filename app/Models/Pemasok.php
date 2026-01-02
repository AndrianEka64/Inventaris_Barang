<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    protected $fillable = [
        'nama_pemasok',
        'alamat',
        'no_telepon'
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'barang_id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class,'pemasok_id');
    }
}
