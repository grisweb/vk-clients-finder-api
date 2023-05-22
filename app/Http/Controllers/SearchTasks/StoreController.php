<?php

namespace App\Http\Controllers\SearchTasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchTasks\StoreSearchTaskRequest;
use App\Jobs\SearchClientsJob;
use App\Models\SearchTask;
use App\Services\ClientsFinder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreSearchTaskRequest $request, ClientsFinder $finder): JsonResponse
    {
        $task = SearchTask::create([
            'uuid' => Str::uuid(),
            ...$request->only(array_keys($request->rules())),
            'user_id' => Auth::user()->id,
            'task_status' => 'in_progress',
        ]);

        SearchClientsJob::dispatch($task->id);

        return $this->response(null, 'Задача создана успешно!');
    }
}
