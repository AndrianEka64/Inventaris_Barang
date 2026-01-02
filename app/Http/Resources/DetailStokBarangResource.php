<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailStokBarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'barang' => $this->barang,
            'tanggal_masuk' => $this->tanggal,
            'jumlah_masuk' => $this->jumlah_masuk,
            'jumlah_keluar' => $this->jumlah_keluar,
            'sisa stok' => $this->stok_akhir,
            'keterangan' => $this->keterangan,
        ];
    }
}
