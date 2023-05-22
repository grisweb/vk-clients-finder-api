<?php

namespace App\Http\Controllers\SearchTasks\FoundUsers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchTasks\FoundUsers\IndexRequest;
use App\Http\Resources\SearchTasks\FoundUserCollection;
use App\Models\FoundUser;
use App\Models\SearchTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request, SearchTask $searchTask): JsonResponse
    {
        if ($searchTask->user_id !== Auth::user()->id) {
            abort(403);
        }

        $foundUsers = $searchTask->foundUsers()->paginate(20);

        return $this->response(new FoundUserCollection($foundUsers));
    }
}
