<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->response(UserResource::collection(User::all()));
    }

    public function me(): JsonResponse
    {
        $user = Auth::user();

        return $this->response(new UserResource($user));
    }
}
