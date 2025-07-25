<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Resources\ItemResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
{
    public function toResponse($request)
    {
        return response()->json([
            'data' => ItemResource::collection($this->collection),
            'meta' => [
                'total' => $this->collection->count(),
                "links" => [
                    'first' => $this->url(1),
                    'last' => $this->url($this->lastPage()),
                    'prev' => $this->previousPageUrl(),
                    'next' => $this->nextPageUrl(),
                ]
            ]
        ]);
    }
}
