<?php

namespace App\Http\Controllers;

use App\Http\Resources\BKResource;
use App\Http\Resources\DetailBKResource;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangkeluar = BarangKeluar::all();
        return BKResource::collection($barangkeluar);
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
        try {
            $validasi = $request->validate([
                'transaksi_id' => 'required|exists:transaksis,id',
                'barang_id' => 'required|exists:barangs,id',
                'qty' => 'required',
                'tanggal_keluar' => 'required',
                'keterangan' => 'required',
            ]);
            $barangkeluar = BarangKeluar::create($validasi);
            return response()->json([
                'message' => 'data barang keluar berhasil ditambah',
                'data' => $barangkeluar
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal menambah data',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $barangkeluar = BarangKeluar::with('transaksi:id,pelanggan_id,barang_id,qty,harga,total', 'barang:id,nama_barang,deskripsi')->find($id);
        return new DetailBKResource($barangkeluar);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validasi = $request->validate([
                'transaksi_id' => 'required',
                'barang_id' => 'required',
                'qty' => 'required',
                'tanggal_keluar' => 'required',
                'keterangan' => 'required',
            ]);
            $barangkeluar = BarangKeluar::find($id);
            $barangkeluar->update($validasi);
            return response()->json([
                'message' => 'data berhasi diubah',
                'data' => $barangkeluar
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal mengubah data barang keluar',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $barangkeluar = BarangKeluar::find($id);
            $barangkeluar->delete();
            return response()->json([
                'message' => 'data berhasil dihapus'
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal menghapus data barang keluar',
                'error' => $th->getMessage()
            ]);
        }
    }
}
