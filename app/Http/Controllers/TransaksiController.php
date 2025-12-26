<?php

namespace App\Http\Controllers;

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
        try {
            $transaksi = Transaksi::all();
            return TransaksiResource::collection($transaksi);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menampilkan data transaksi',
                'error' => $th->getMessage()
            ]);
        }
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
            $barang = Barang::find($data['barang_id']);
            $data['harga'] = $barang->harga;
            $data['total'] = $data['qty'] * $data['harga'];
            $transaksi = Transaksi::create($data);
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
    public function show(Transaksi $transaksi)
    {
        //
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
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
