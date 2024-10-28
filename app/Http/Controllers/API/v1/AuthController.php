<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        //
    }

    public function login()
    {
        
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