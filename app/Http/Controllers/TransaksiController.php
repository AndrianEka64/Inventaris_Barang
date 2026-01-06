<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailTransaksiResource;
use App\Http\Resources\TransaksiResource;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        return TransaksiResource::collection($transaksi);
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
            $data = $request->validate([
                'pelanggan_id' => 'required|exists:pelanggans,id',
                'barang_id' => 'required|exists:barangs,id',
                'qty' => 'required|integer|min:1',
            ]);
            $barang = Barang::findOrFail($data['barang_id']);
            if ($data['qty'] > $barang->stok) {
                return response()->json([
                    'message' => 'Stok barang tidak mencukupi',
                    'banyak stok' => $barang->stok
                ]);
            }
            $data['harga'] = $barang->harga;
            $data['total'] = $data['qty'] * $data['harga'];
            $transaksi = Transaksi::create($data);
            $barang->decrement('stok', $data['qty']);
            return response()->json([
                'message' => 'Transaksi berhasil disimpan',
                'data' => $transaksi
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menyimpan trnsaksi',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with('pelanggan:id,nama_pelanggan,alamat', 'barang:id,nama_barang')->find($id);
        return new DetailTransaksiResource($transaksi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'pelanggan_id' => 'required|exists:pelanggans,id',
                'barang_id' => 'required|exists:barangs,id',
                'qty' => 'required|integer|min:1',
            ]);
            $barang = Barang::findOrFail($data['barang_id']);
            if ($data['qty'] > $barang->stok) {
                return response()->json([
                    'message' => 'Stok barang tidak mencukupi',
                    'banyak stok' => $barang->stok
                ]);
            }
            $data['harga'] = $barang->harga;
            $data['total'] = $data['qty'] * $data['harga'];
            $transaksi = Transaksi::find($id);
            $transaksi->update($data);
            return response()->json([
                'message' => 'data transaksi berhasil diubah',
                'data' => $transaksi
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal mengubah data transaksi',
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
            $transaksi = Transaksi::find($id);
            $transaksi->delete();
            return response()->json([
                'message' => 'data transaksi berhasil dihapus',
                'data yang dihapus' => $transaksi
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal menghapus data transaksi',
                'error' => $th->getMessage()
            ]);
        }
    }
}