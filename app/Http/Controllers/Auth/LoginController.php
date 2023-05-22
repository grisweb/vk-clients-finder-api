<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function __invoke(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->response(null, 'Неверный email или пароль!', 401);
        }

        $user = User::where('email', $request->get('email'))->first();

        return $this->response([
            'user' => new UserResource($user),
            'access_token' => $user->createToken($user->email)->plainTextToken,
        ]);
    }
}
