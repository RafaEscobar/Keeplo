<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\VahulStoreRequest;
use App\Http\Requests\Update\VahulUpdateRequest;
use App\Http\Resources\Collections\VahulCollection;
use App\Http\Resources\Resources\VahulResource;
use App\Models\Vahul;
use Illuminate\Http\Request;

class VahulController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Vahul::class, 'vahul');
    }

    public function index(Request $request)
    {
        $vahuls = $request->user()
                        ->vahuls()
                        ->paginate($request->input('limit'));

        return new VahulCollection($vahuls);
    }

    public function store(VahulStoreRequest $request)
    {
        $vahul = $request->user()
                    ->vahuls()
                    ->create($request->validated());
        $vahul->addMediaFromRequest('image')
              ->toMediaCollection('cover_vahul');
        return new VahulResource($vahul);
    }

    public function update(VahulUpdateRequest $request, Vahul $vahul)
    {
        $vahul->update($request->validated());
        if ($request->has('image')) {
            $vahul->clearMediaCollection('cover_vahul')
                ->addMediaFromRequest('image')
                ->toMediaCollection('cover_vahul');
        }
        return new VahulResource($vahul);
    }

    public function show(Vahul $vahul)
    {
        return new VahulResource($vahul);
    }

    public function destroy(Vahul $vahul)
    {
        $vahul->delete();
        return response()->noContent();
    }
}
