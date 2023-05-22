<?php

namespace App\Http\Resources\SearchTasks;

use App\Http\Resources\ResourceCollectionWithPaginate;
use Illuminate\Http\Request;

class SearchTaskCollection extends ResourceCollectionWithPaginate
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tasks' => $this->collection,
            'meta' => [
                ...$this->pagination()
            ]
        ];
    }
}
