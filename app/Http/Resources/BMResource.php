<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BMResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'pemasok_id'=>$this->pemasok->nama_pemasok,
            'barang_id'=>$this->barang->nama_barang,
            'qty'=>$this->qty,
            'harga_beli'=>$this->harga_beli,
            'tanggal_masuk'=>$this->tanggal_masuk,
        ];
    }
}
