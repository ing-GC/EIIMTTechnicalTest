<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'users retrieved susccessful',
            'data' => UserResource::collection(User::all()),
        ], JsonResponse::HTTP_OK);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json([
            'message' => 'user created susccessful',
            'data' => UserResource::make($user),
        ], JsonResponse::HTTP_CREATED);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'message' => 'user retrieved susccessful',
            'data' => UserResource::make($user),
        ], JsonResponse::HTTP_OK);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        return response()->json([
            'message' => 'user updated susccessful',
            'data' => UserResource::make($user),
        ], JsonResponse::HTTP_OK);
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
