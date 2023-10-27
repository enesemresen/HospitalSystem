<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserIdentity;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateUserIdentityRequest;
use App\Http\Requests\UpdateUserIdentityRequest;
use App\Http\Resources\UserIdentityResource;

class UserIdentityController extends Controller
{
    public function index(): JsonResponse
    {
        $userIdentites = UserIdentity::with(
            'user',
        )->get();

        return response()->json([
            'data' => UserIdentityResource::collection($userIdentites),
        ]);
    }

    public function store(CreateUserIdentityRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new UserIdentityResource(UserIdentity::create($request->validated())),
        ]);
    }

    public function show(UserIdentity $userIdentity): JsonResponse
    {
        return response()->json([
            'data' => new UserIdentityResource($userIdentity->load('user')),
        ]);
    }

    public function update(UpdateUserIdentityRequest $request, UserIdentity $userIdentity): JsonResponse
    {
        $userIdentity->update($request->validated());

        return response()->json([
            'data' => new UserIdentityResource($userIdentity->fresh()),
        ]);
    }

    public function destroy(UserIdentity $userIdentity): JsonResponse
    {
        $userIdentity->delete();
        return response()->json([], 204);
    }

}