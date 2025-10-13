<?php

namespace App\Http\Resources\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status,
            'observation' => $this->observation,
            'vahul_id' => $this->vahul_id,
            'amount' => $this->amount,
            'image' => $this->getFirstMediaUrl('item_cover'),
        ];
    }
}
