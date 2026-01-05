<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Pelanggan;
use App\Models\Pemasok;
use App\Models\StokBarang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function barang()
    {
        $totalbarang = Barang::sum('stok');
        return response()->json([
            'message' => 'berhasil menampilkan total barang',
            'Total_Barang' => $totalbarang
        ]);
    }
    public function pemasok()
    {
        $totalpemasok = Pemasok::count();
        return response()->json([
            'message' => 'berhasil menampilkan total pemasok',
            'Total_pemasok' => $totalpemasok
        ]);
    }
    public function pelanggan()
    {
        $totalpelanggan = Pelanggan::count();
        return response()->json([
            'message' => 'berhasil menampilkan total pelanggan',
            'Total_pelanggan' => $totalpelanggan
        ]);
    }
    public function transaksi()
    {
        $totaltransaksi = Transaksi::count();
        return response()->json([
            'message' => 'berhasil menampilkan total transaksi',
            'Total_transaksi' => $totaltransaksi
        ]);
    }

    public function barangmasuk()
    {
        $barangmasuk = BarangMasuk::sum('qty');
        return response()->json([
            'message' => 'Total barang masuk',
            'Total' => $barangmasuk
        ]);
    }
    public function barangkeluar()
    {
        $barangkeluar = BarangKeluar::sum('qty');
        return response()->json([
            'message' => 'Total barang keluar',
            'Total' => $barangkeluar
        ]);
    }
    public function pelangganterakhir()
    {
        $terakhir = Pelanggan::orderBy('id', 'desc')->first();
        return response()->json([
            'message' => 'Data Pelanggan yang terakhir ditambahkan',
            'data' => $terakhir
        ]);
    }
    public function pemasokterakhir()
    {
        $terakhir = Pemasok::orderBy('id', 'desc')->first();
        return response()->json([
            'message' => 'Data Pemasok yang terakhir ditambahkan',
            'data' => $terakhir
        ]);
    }

    public function barangterakhir()
    {
        $terakhir = Barang::orderBy('id', 'desc')->first();
        return response()->json([
            'message' => 'Data Barang yang terakhir ditambahkan',
            'data' => $terakhir
        ]);
    }

    public function transaksiterakhir()
    {
        $terakhir = Transaksi::orderBy('id', 'desc')->first();
        return response()->json([
            'message' => 'Data Transaksi yang terakhir ditambahkan',
            'data' => $terakhir
        ]);
    }
    public function menipis()
    {
        $stokbarang = StokBarang::where('stok_akhir','<=',5)->get();
        return response()->json([
            'message'=>'Stok barang yang hampir habis',
            'data'=>$stokbarang
        ]);
    }
}
