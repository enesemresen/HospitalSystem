<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analyse;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateAnalyseRequest;
use App\Http\Requests\UpdateAnalyseRequest;
use App\Http\Resources\AnalyseResource;

class AnalyseController extends Controller
{
    public function index(): JsonResponse
    {
        $search = request('patinet_id');
        $analyses = Analyse::with('createdBy', 'patient', 'personal')->get();
        
        if($search)
        {
            $analyses = Analyse::where('patient_id', $search)->get();
        }

        return response()->json([
            'data' => AnalyseResource::collection($analyses),
        ]);
    }

    public function store(CreateAnalyseRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new AnalyseResource(Analyse::create($request->validated())),
        ]);
    }

    public function show(Analyse $analyse): JsonResponse
    {
        return response()->json([
            'data' => new AnalyseResource($analyse->load('createdBy', 'patient', 'personal')),
        ]);
    }

    public function update(UpdateAnalyseRequest $request, Analyse $analyse): JsonResponse
    {
        $analyse->update($request->validated());

        return response()->json([
            'data' => new AnalyseResource($analyse->fresh()),
        ]);
    }

    public function destroy(Analyse $analyse): JsonResponse
    {
        $analyse->delete();
        return response()->json([], 204);
    }
}