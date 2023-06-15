<?php

namespace App\Http\Controllers\Favorites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorites\DeleteRequest;
use App\Models\Favorite;
use App\Models\FoundUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(DeleteRequest $request)
    {
        $foundUser = FoundUser::where('uuid', $request->get('user_id'))->with('task')->firstOrFail();

        if ($foundUser->task->user_id !== Auth::user()->id) {
            abort(403);
        }

        $favorite = Favorite::where('found_user_id', $foundUser->id)->firstOrFail();
        $favorite->delete();
    }
}
