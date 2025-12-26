<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailTransaksiResource extends JsonResource
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
            'pelanggan' => $this->pelanggan,
            'barang' => $this->barang,
            'harga_satuan' => $this->harga,
            'jumlah' => $this->qty,
            'total_harga' => $this->total,
        ];
    }
}
