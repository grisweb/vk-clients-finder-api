<?php

namespace App\Http\Controllers\Favorites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorites\StoreRequest;
use App\Models\Favorite;
use App\Models\FoundUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): JsonResponse
    {
        $foundUser = FoundUser::where('uuid', $request->get('user_id'))->firstOrFail();

        Favorite::create([
            'user_id' => $foundUser->id
        ]);

        return $this->response();
    }
}
