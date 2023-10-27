<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Http\Resources\HospitalResource;

class HospitalController extends Controller
{
    public function index(): JsonResponse
    {
        $hospitals = Hospital::with(
            'polyclinics',
        )->get();

        return response()->json([
            'data' => HospitalResource::collection($hospitals),
        ]);
    }

    public function store(CreateHospitalRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new HospitalResource(Hospital::create($request->validated())),
        ]);
    }

    public function show(Hospital $hospital): JsonResponse
    {
        return response()->json([
            'data' => new HospitalResource($hospital->load(
                'polyclinics',
            )),
        ]);
    }

    public function update(UpdateHospitalRequest $request, Hospital $hospital): JsonResponse
    {
        $hospital->update($request->validated());

        return response()->json([
            'data' => new HospitalResource($hospital->fresh()),
        ]);
    }

    public function destroy(Hospital $hospital): JsonResponse
    {
        $hospital->delete();
        return response()->json([], 204);
    }
}