<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_telepon',
    ];
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'pelanggan_id');
    } 
}
