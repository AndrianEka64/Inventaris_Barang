<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailBMResource extends JsonResource
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
            'pemasok'=>$this->pemasok,
            'barang'=>$this->barang,
            'qty'=>$this->qty,
            'harga_beli'=>$this->harga_beli,
            'tanggal_masuk'=>$this->tanggal_masuk,
        ];
    }
}
