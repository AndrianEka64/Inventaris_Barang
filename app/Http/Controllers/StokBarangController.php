<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailStokBarangResource;
use App\Http\Resources\StokBarangResource;
use App\Models\StokBarang;
use Illuminate\Http\Request;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokbarang = StokBarang::all();
        return StokBarangResource::collection($stokbarang);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal' => 'required',
            'jumlah_masuk' => 'required',
            'jumlah_keluar' => 'required',
            'keterangan' => 'required',
        ]);
        $validasi['stok_akhir'] = $validasi['jumlah_masuk'] - $validasi['jumlah_keluar'];
        $stokbarang = StokBarang::create($validasi);
        return response()->json([
            'message' => 'data stok barang berhasil ditambah',
            'data' => $stokbarang
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $stokbarang = StokBarang::with('barang:id,pemasok_id,nama_barang,deskripsi,harga')->find($id);
        return new DetailStokBarangResource($stokbarang);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StokBarang $stokBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal' => 'required',
            'jumlah_masuk' => 'required',
            'jumlah_keluar' => 'required',
            'keterangan' => 'required',
        ]);
        $validasi['stok_akhir'] = $validasi['jumlah_masuk'] - $validasi['jumlah_keluar'];
        $stokbarang = StokBarang::find($id);
        $stokbarang->update($validasi);
        return response()->json([
            'message'=>'data stok barang berhasil diubah',
            'data'=>$stokbarang
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stokbarang = StokBarang::find($id);
        $stokbarang->delete();
        return response()->json([
            'message' => 'data stok barang berhasil dihapus',
            'data yang dihapus' => $stokbarang
        ]);
    }
}
