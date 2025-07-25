<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Resources\VahulResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VahulCollection extends ResourceCollection
{
    public function toResponse($request)
    {
        return response()->json([
            "data" => VahulResource::collection($this->collection),
            "meta" => [
                "total" => $this->collection->count(),
                "links" => [
                    "first" => $this->url(1),
                    "last" => $this->url($this->lastPage()),
                    "prev" => $this->previousPageUrl(),
                    "next" => $this->nextPageUrl(),
                ]
            ]
        ]);
    }
}
