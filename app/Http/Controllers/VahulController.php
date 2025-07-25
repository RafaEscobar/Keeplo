<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\VahulStoreRequest;
use App\Http\Resources\Collections\VahulCollection;
use App\Http\Resources\Resources\VahulResource;
use App\Models\Vahul;
use Illuminate\Support\Facades\Auth;

class VahulController extends Controller
{
    public function index()
    {
        try {
            $vahuls = Auth::user()->vahuls();
            return new VahulCollection($vahuls);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function store(VahulStoreRequest $request)
    {
        try {
            $vahul = Vahul::create($request->validated());
            $vahul->addMediaFromRequest('image')->toMediaCollection('vahuls');
            return new VahulResource($vahul);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function update()
    {
        try {

        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function show()
    {
        try {

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
