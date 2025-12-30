<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailBarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Message'=>'Detail Barang',
            'id' => $this->id,
            'pemasok_barang'=>$this->pemasok,
            'gambar_barang' => $this->gambar_barang,
            'nama_barang' => $this->nama_barang,
            'deskripsi_barang' => $this->deskripsi,
            'harga' => $this->harga,
            'persediaan' => $this->stok,
            'tanggal_masuk'=>$this->created_at->format('Y-m-d')
        ];
    }
}
