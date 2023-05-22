<?php

namespace App\Http\Controllers\SearchTasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchTasks\SearchTaskResource;
use App\Models\SearchTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SearchTask $searchTask): JsonResponse
    {
        if ($searchTask->user_id !== Auth::user()->id) {
            abort(403);
        }

        return $this->response(new SearchTaskResource($searchTask));
    }
}
