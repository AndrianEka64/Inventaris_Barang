<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pemasok;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function barang()
    {
        $totalbarang = Barang::count();
        return response()->json([
            'message'=>'berhasil menampilkan total barang',
            'Total_Barang'=>$totalbarang
        ]);
    }
    public function pemasok()
    {
        $totalpemasok = Pemasok::count();
        return response()->json([
            'message'=>'berhasil menampilkan total pemasok',
            'Total_pemasok'=>$totalpemasok
        ]);
    }
    public function pelanggan()
    {
        $totalpelanggan = Pelanggan::count();
        return response()->json([
            'message'=>'berhasil menampilkan total pelanggan',
            'Total_pelanggan'=>$totalpelanggan
        ]);
    }
    public function transaksi()
    {
        $totaltransaksi = Transaksi::count();
        return response()->json([
            'message'=>'berhasil menampilkan total transaksi',
            'Total_transaksi'=>$totaltransaksi
        ]);
    }
}
