<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\ItemStoreRequest;
use App\Http\Requests\Update\ItemUpdateRequest;
use App\Http\Resources\Collections\ItemCollection;
use App\Http\Resources\Resources\ItemResource;
use App\Models\Item;
use App\Models\Vahul;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Item::class, 'item');
    }
    public function index(Request $request)
    {
        $requestValidated = $request->validate(['vahul_id' => 'required',], ['vahul_id.required' => 'El vahul asociado es requerido']);
        $items = Item::where('vahul_id', $requestValidated['vahul_id'])
                    ->when($request->has('search'), function($q) use ($request){
                        $q->where('name', 'like', '%'.$request->search.'%');
                    })
                    ->orderBy('created_at', $request->input('order') ?? 'desc')
                    ->paginate($request->input('limit'));
        return new ItemCollection($items);
    }

    public function store(ItemStoreRequest $request)
    {
        $vahul = Vahul::find($request->input('vahul_id'));
        if ($vahul) {
            $item = $vahul->items()
                        ->create($request->validated());
            $item->addMediaFromRequest('image')
                ->toMediaCollection('item_cover');
            return new ItemResource($item);
        } else {
            return response()->json(["message" => "Vahul asociado no encontrado"]);
        }
    }

    public function update(ItemUpdateRequest $request, Item $item)
    {
        $item->update($request->validated());
        if ($request->has('image')) {
            $item->addMediaFromRequest('image')
                ->toMediaCollection('item_cover');
        }
        return new ItemResource($item);
    }

    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->noContent();
    }

    public function getRandomItem(Request $request)
    {
        $vahul = Vahul::find($request->input('vahul_id'));
        if ($vahul != null) {
            $item = $vahul->items()
                ->inRandomOrder()
                ->first();
            return new ItemResource($item);
        }
        return response()->noContent();
    }
}
