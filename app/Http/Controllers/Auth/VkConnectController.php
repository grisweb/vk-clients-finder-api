<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;
use App\Services\VkApi;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VkConnectController extends Controller
{
    /**
     * @throws RequestException
     */
    public function __invoke(Request $request, VkApi $api): JsonResponse
    {
        $request->validate([
            'code' => 'string|required'
        ]);

        $user = $api->authorize($request->get('code'));

        return $this->response(new UserResource($user));
    }
}
