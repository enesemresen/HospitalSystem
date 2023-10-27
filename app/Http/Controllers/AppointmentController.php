<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\View\AnonymousComponent;

class AppointmentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $appointments = Appointment::with('barcode', 'personal', 'patient')->get();

        return  AppointmentResource::collection($appointments);
    }

    public function store(CreateAppointmentRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new AppointmentResource(Appointment::create($request->validated())),
        ]);
    }

    public function show(Appointment $appointment): JsonResponse
    {
        $appointment->load('barcode');
        
        return response()->json([
            'data' => new AppointmentResource($appointment->load('barcode', 'personal', 'patient')),
        ]);
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        $appointment->update($request->validated());

        return response()->json([
            'data' => new AppointmentResource($appointment->fresh()),
        ]);
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->delete();
        return response()->json([], 204);
    }
}