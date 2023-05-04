<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->credentials())) {
            return response()->json([
                'message' => 'The user credentials were incorrect',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'access_token' => Auth::user()->createToken($request->email)->plainTextToken,
            'token_type' => 'Bearer',
        ], JsonResponse::HTTP_OK);
    }
}
