<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Polyclinic;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreatePolyclinicRequest;
use App\Http\Requests\UpdatePolyclinicRequest;
use App\Http\Resources\PolyclinicResource;

class PolyclinicController extends Controller
{
    public function index(): JsonResponse
    {
        $polyclinics = Polyclinic::with(
            'hospital',
            'personal',
        )->get();

        return response()->json([
            'data' => PolyclinicResource::collection($polyclinics),
        ]);
    }

    public function store(CreatePolyclinicRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new PolyclinicResource(Polyclinic::create($request->validated())),
        ]);
    }

    public function show(Polyclinic $polyclinic): JsonResponse
    {
        return response()->json([
            'data' =>new PolyclinicResource( $polyclinic->load(
                'hospital',
                'personal',
            )),
        ]);
    }

    public function update(UpdatePolyclinicRequest $request, Polyclinic $polyclinic): JsonResponse
    {
        $polyclinic->update($request->validated());

        return response()->json([
            'data' => new PolyclinicResource($polyclinic->fresh()),
        ]);
    }

    public function destroy(Polyclinic $polyclinic): JsonResponse
    {
        $polyclinic->delete();
        return response()->json([], 204);
    }
}
