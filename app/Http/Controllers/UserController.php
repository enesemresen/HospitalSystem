<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\UserIdentity;
use Illuminate\Contracts\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::with(
            'userIdentity',
            'appointmentsPatient',
            'appointmentsPersonal',
            'polyclinics',
            'analysesCreated',
            'analysesPatient',
            'analysesPersonal',
        )->get();

        return response()->json([
            'data' => UserResource::collection($users),
        ]);

    }
    
    public function store(CreateUserRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new UserResource(User::create($request->validated())),
        ]);
    }
    
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => new UserResource($user->load(
                'userIdentity',
                'appointmentsPatient',
                'appointmentsPersonal',
                'polyclinics',
                'analysesCreated',
                'analysesPatient',                
                'analysesPersonal',
            )),
        ]);
    }
    
    public function update(UpdateUserRequest  $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        return response()->json([
            'data' => new UserResource($user->fresh()),
        ]);
    }
    
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([], 204);
    }

    public function getAllDoctors(User $user): JsonResponse
    {
        //$users = User::where('role', 'doctor')->get();

        $doctors = User::getDoctors()->get();

        return response()->json([
            'data' => UserResource::collection($doctors),
        ]);
    }

    public function getAllIdentityAndAnalyse(): JsonResponse
    {
        $users = User::with
            (
            'analysesPatient:id, patient_id, result', 
            'userIdentity:id, user_id, tc_no'
            )
            ->get();

        return response()->json([
            'data' => UserResource::collection($users),
        ]);
    }

    public function getIdentityWithMotherName():JsonResponse
    {
        $users = User::wherehas('userIdentity', function($query){
                $query->where('mother_name', 'Lizeth');
            })
            ->with('userIdentity')
            ->get();

        return response()->json([
            'data' => UserResource::collection($users),
        ]);
    }

}