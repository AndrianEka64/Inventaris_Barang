<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return[
        'id' => $this->id,
        'pelanggan' => $this->pelanggan->nama_pelanggan,
        'barang' => $this->barang->nama_barang,
        'qty' => $this->qty,
        'harga' => $this->barang->harga,
        'total' => $this->total,
        'tanggal' => $this->created_at->format('Y-m-d'),
       ];
    }
}
