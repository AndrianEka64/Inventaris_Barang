<?php

namespace App\Http\Controllers;

use App\Http\Resources\PelangganResource;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pelanggan = Pelanggan::all();
            return PelangganResource::collection($pelanggan);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menampilkan data pelanggan',
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
                'nama_pelanggan' => 'required|string',
                'alamat' => 'required|string',
                'no_telepon' => 'required',
            ]);
            $pelanggan = Pelanggan::create($data);
            return response()->json([
                'message'=>'data pelanggan berasil ditambahkan',
                'data'=>$pelanggan
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menyimpan data pelanggan',
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
            $pelanggan = Pelanggan::find($id);
            return response()->json([
                'message' => 'Data pelanggan berhasil ditampilkan',
                'data' => $pelanggan
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menampilkan data pelanggan',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
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
                'nama_pelanggan' => 'required|string',
                'alamat' => 'required|string',
                'no_telepon' => 'required|string',
            ]);
            $pelanggan = Pelanggan::find($id);
            $pelanggan->update($data);
            return response()->json([
                'message' => 'Data pelanggan berhasil diubah',
                'data' => $pelanggan
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal mengubah data pelanggan',
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
            $pelanggan = Pelanggan::find($id);
            $pelanggan->delete();
            return response()->json([
                'message' => 'Data pelanggan berhasil dihapus',
                'data yang dihapus' => $pelanggan
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal menghapus data pelanggan',
                'error' => $th->getMessage()
            ]);
        }
    }
}
