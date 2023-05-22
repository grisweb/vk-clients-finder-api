<?php

namespace App\Http\Controllers\SearchTasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchTasks\IndexRequest;
use App\Http\Resources\SearchTasks\SearchTaskCollection;
use App\Models\SearchTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request): JsonResponse
    {
        $tasks = SearchTask::query()
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->paginate(5);

        return $this->response(new SearchTaskCollection($tasks));
    }
}
