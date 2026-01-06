<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailPemasokResource;
use App\Http\Resources\PemasokResource;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasok = Pemasok::all();
        return PemasokResource::collection($pemasok);
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
                'nama_pemasok' => 'required',
                'alamat' => 'required',
                'no_telepon' => 'required'
            ]);
            $pemasok = Pemasok::create($data);
            return response()->json([
                'message' => 'Data Pemasok Berhasil ditambah',
                'data' => $pemasok
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal menambah data pemasok',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        return response()->json([
            'message' => 'data berhasil ditampilkan',
            'data' => $pemasok
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasok $pemasok)
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
                'nama_pemasok' => 'required',
                'alamat' => 'required',
                'no_telepon' => 'required'
            ]);
            $pemasok = Pemasok::find($id);
            $pemasok->update($data);
            return response()->json([
                'message' => 'Data Berhasil Diupdate',
                'data' => $pemasok
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal mengubah data',
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
            $pemasok = Pemasok::find($id);
            $pemasok->delete();
            return response()->json([
                'message' => 'data berhasil dihapus',
                'data' => $pemasok
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'gagal menghapus data pemaasok',
                'error' => $th->getMessage()
            ]);
        }
    }
}
