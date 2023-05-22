<?php

namespace App\Http\Resources\SearchTasks;

use App\Http\Resources\ResourceCollectionWithPaginate;
use App\Models\FoundUser;
use Illuminate\Http\Request;

/**
 * @mixin FoundUser
 */
class FoundUserCollection extends ResourceCollectionWithPaginate
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'found_users' => $this->collection,
            'meta' => $this->pagination()
        ];
    }
}
