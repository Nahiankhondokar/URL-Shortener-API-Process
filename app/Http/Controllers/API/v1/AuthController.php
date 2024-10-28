<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        //
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->all();
        if(!Auth::attempt($credentials)){
            return $this->errorApiResponse('Unauthorised', Response::HTTP_UNAUTHORIZED);
        }
        
        $user = Auth::user();
        $token = $request->user()->createToken('api_token')->plainTextToken;

        $response['token'] = $token;
        $response['user'] = $user;
        return $this->successApiResponse($response, 'User login successfully');
    }

    public function register(RegisterRequest $request)
    {
       try {
            $user = User::query()->create($request->validated());
            return $this->successApiResponse(new UserResource($user), 'User registration successful');
       } catch (\Throwable $th) {
            return $this->errorApiResponse($th->getMessage());
       }
    }
}