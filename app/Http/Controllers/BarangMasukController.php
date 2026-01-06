<?php

namespace App\Http\Controllers;

use App\Http\Resources\BMResource;
use App\Http\Resources\DetailBMResource;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangmasuk = BarangMasuk::all();
        return BMResource::collection($barangmasuk);
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
                'pemasok_id' => 'required|exists:pemasoks,id',
                'barang_id' => 'required|exists:barangs,id',
                'qty' => 'required',
                'tanggal_masuk' => 'required',
            ]);
            $barang = Barang::findOrFail($validasi['barang_id']);
            $validasi['harga'] = $barang->harga;
            $validasi['harga_beli'] = $validasi['qty'] * $validasi['harga'];
            $barangmasuk = BarangMasuk::create($validasi);
            return response()->json([
                'message' => 'data barang masuk berhasil ditambah',
                'data' => $barangmasuk
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal menambah data barang masuk',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $barangmasuk = BarangMasuk::with('pemasok:id,nama_pemasok,alamat,no_telepon', 'barang:id,nama_barang,deskripsi')->find($id);
        return new DetailBMResource($barangmasuk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
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
                'pemasok_id' => 'required',
                'barang_id' => 'required',
                'qty' => 'required',
                'tanggal_masuk' => 'required',
            ]);
            $barangmasuk = BarangMasuk::find($id);
            $barang = Barang::findOrFail($validasi['barang_id']);
            $validasi['harga'] = $barang->harga;
            $validasi['harga_beli'] = $validasi['qty'] * $validasi['harga'];
            $barangmasuk->update($validasi);
            return response()->json([
                'message' => 'data berhasil diubah',
                'data' => $barangmasuk
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal mengubah data barang masuk',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::find($id);
        $barangmasuk->delete();
        return response()->json([
            'message' => 'data berhasil dihapus',
            'data yang dihapus'
        ]);
    }
}
