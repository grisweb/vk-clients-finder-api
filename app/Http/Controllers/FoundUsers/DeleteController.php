<?php

namespace App\Http\Controllers\FoundUsers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoundUsers\DeleteRequest;
use App\Http\Resources\SearchTasks\FoundUserResource;
use App\Models\FoundUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(DeleteRequest $request): JsonResponse
    {
        $foundUser = FoundUser::where('uuid', $request->get('user_id'))->with('task')->firstOrFail();

        if ($foundUser->task->user_id !== Auth::user()->id) {
            abort(403);
        }

        $foundUser->delete();

        return $this->response(new FoundUserResource($foundUser));
    }
}
