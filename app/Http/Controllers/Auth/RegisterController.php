<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'uuid' => Str::uuid(),
            ...$request->only(['name', 'email', 'password'])
        ]);

        return $this->response([
            'user' => new UserResource($user),
            'access_token' => $user->createToken($user->email)->plainTextToken
        ]);
    }
}
