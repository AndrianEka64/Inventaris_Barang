<?php

namespace App\Http\Controllers;

use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $barang = Barang::all();
            return BarangResource::collection($barang);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menampilkan data barang',
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
                'nama_barang' => 'required|string',
                'harga' => 'required|integer',
                'stok' => 'required|integer',
            ]);
            $barang = Barang::create($data);
            return response()->json([
                'message' => 'Data barang berhasil ditambahkan',
                'data' => $barang
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menambahdata barang',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $barang = Barang::find($id);
            return response()->json([
                'message' => 'Data barang berhasil ditampilkan',
                'data' => $barang
            ]);
        } catch (\Exception$th) {
            return response()->json([
                'message' => 'Gagal menampilkan data barang',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
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
                'nama_barang' => 'required|string',
                'harga' => 'required|integer',
                'stok' => 'required|integer',
            ]);
            $barang = Barang::find($id);
            $barang->update($data);
            return response()->json([
                'message' => 'Data barang berhasil diubah',
                'data' => $barang
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal mengubah data barang',
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
            $barang = Barang::find($id);
            $barang->delete();
            return response()->json([
                'message' => 'Data barang berhasil dihapus',
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menghapus data barang',
                'error' => $th->getMessage()
            ]);
        }
    }
}
