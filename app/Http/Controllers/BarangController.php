<?php

namespace App\Http\Controllers;

use App\Http\Resources\BarangResource;
use App\Http\Resources\DetailBarangResource;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
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
                'pemasok_id' => 'required|exists:pemasoks,id',
                'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nama_barang' => 'required|string',
                'deskripsi' => 'required|string',
                'harga' => 'required|integer',
                'stok' => 'required|integer',
            ]);
            $gambar = $request->file('gambar_barang');
            $gambar->storeAs('public', $gambar->hashName());
            $barang = Barang::create([
                'pemasok_id' => $data['pemasok_id'],
                'gambar_barang' => $gambar->hashName(),
                'nama_barang' => $data['nama_barang'],
                'deskripsi' => $data['deskripsi'],
                'harga' => $data['harga'],
                'stok' => $data['stok']
            ]);
            return response()->json([
                'message' => 'Data barang berhasil ditambahkan',
                'data' => $barang
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menambah data barang',
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
            $barang = Barang::with('pemasok:id,nama_pemasok,alamat,no_telepon')->find($id);
            return new DetailBarangResource($barang);
        } catch (\Exception $th) {
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
                'pemasok_id' => 'required|exists:pemasoks,id',
                'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nama_barang' => 'required|string',
                'deskripsi' => 'required|string',
                'harga' => 'required|integer',
                'stok' => 'required|integer',
            ]);
            $barang = Barang::find($id);
            if ($request->hasFile('gambar_barang')) {
                Storage::delete(['public' . basename($barang->gambar_barang)]);
                $gambar = $request->file('gambar_barang');
                $gambar->storeAs('public', $gambar->hashName());
                $barang->update([
                    'gambar_barang' => $gambar->hashName(),
                    'nama_barang' => $data['nama_barang'],
                    'deskripsi' => $data['deskripsi'],
                    'harga' => $data['harga'],
                    'stok' => $data['stok']
                ]);
            } else {
                $barang->update([
                    'pemasok_id'=>$data['pemasok_id'],
                    'nama_barang' => $data['nama_barang'],
                    'deskripsi' => $data['deskripsi'],
                    'harga' => $data['harga'],
                    'stok' => $data['stok']
                ]);
            }
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
            Storage::delete('public/'.basename($barang->gambar_barang));
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
