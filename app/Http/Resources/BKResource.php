<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BKResource extends JsonResource
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
            'transaksi_id' => $this->transaksi->id,
            'barang_id' => $this->barang->nama_barang,
            'qty' => $this->qty,
            'tanggal_keluar' => $this->tanggal_keluar,
        ];
    }
}
