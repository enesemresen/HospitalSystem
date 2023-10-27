<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barcode;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateBarcodeRequest;
use App\Http\Requests\UpdateBarcodeRequest;
use App\Http\Resources\BarcodeResource;

class BarcodeController extends Controller
{
    public function index(): JsonResponse
    {
        $barcodes = Barcode::with
            (
            'appointment',
            'appointment.personal',
            'appointment.patient',
            )
            ->get();
        return response()->json([
            'data' => BarcodeResource::collection($barcodes),
        ]);
    }

    public function store(CreateBarcodeRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new BarcodeResource(Barcode::create($request->validated())),
        ]);
    }

    public function show(Barcode $barcode): JsonResponse
    {
        $barcode->load(            
        'appointment',
        'appointment.personal',
        'appointment.patient',);
        return response()->json([
            'data' => new BarcodeResource($barcode),
        ]);
    }

    public function update(UpdateBarcodeRequest $request, Barcode $barcode): JsonResponse
    {
        $barcode->update($request->validated());

        return response()->json([
            'data' => new BarcodeResource($barcode->fresh()),
        ]);
    }

    public function destroy(Barcode $barcode): JsonResponse
    {
        $barcode->delete();
        return response()->json([], 204);
    }
}
