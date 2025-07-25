<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\VahulStoreRequest;
use App\Http\Requests\Update\VahulUpdateRequest;
use App\Http\Resources\Collections\VahulCollection;
use App\Http\Resources\Resources\VahulResource;
use App\Models\Vahul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VahulController extends Controller
{
    public function index(Request $request)
    {
        try {
            $vahuls = Auth::user()->vahuls()->paginate($request->input('limit'));
            return new VahulCollection($vahuls);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function store(VahulStoreRequest $request)
    {
        try {
            $vahul = Vahul::create($request->validated());
            $vahul->addMediaFromRequest('image')->toMediaCollection('cover_vahul');
            return new VahulResource($vahul);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function update(VahulUpdateRequest $request, Vahul $vahul)
    {
        try {
            $vahul->update($request->validated());
            $vahul->addMediaFromRequest('image')->toMediaCollection('cover_vahul');
            return new VahulResource($vahul);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function show(Vahul $vahul)
    {
        try {
            return new VahulResource($vahul);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function destroy()
    {
        try {

        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
