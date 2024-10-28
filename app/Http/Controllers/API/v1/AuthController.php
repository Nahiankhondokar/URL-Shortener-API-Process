<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        //
    }

    public function login()
    {
        
    }

    public function register(RegisterRequest $request)
    {
    //    try {

    //     $user = User::query()->create($request->validated());

    //    } catch (\Throwable $th) {
    //     //throw $th;
    //    }
    }
}