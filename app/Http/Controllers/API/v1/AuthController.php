<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponse;
    
    public function index(): JsonResponse
    {
        $users = User::query()->get();
        return $this->successApiResponse($users, "User list");
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->all();
        if(!Auth::attempt($credentials)){
            return $this->errorApiResponse('Unauthorised', Response::HTTP_UNAUTHORIZED);
        }
        
        $user = Auth::user();
        $token = $request->user()->createToken('api_token')->plainTextToken;

        return $this->successApiResponse($user, 'User login successfully', Response::HTTP_OK, ['token' => $token]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
       try {
            $user = User::query()->create($request->validated());
            return $this->successApiResponse(new UserResource($user), 'User registration successful');
       } catch (\Throwable $th) {
            return $this->errorApiResponse($th->getMessage());
       }
    }
}