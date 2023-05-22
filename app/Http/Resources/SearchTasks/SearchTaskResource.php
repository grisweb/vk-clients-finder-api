<?php

namespace App\Http\Resources\SearchTasks;

use App\Models\SearchTask;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin SearchTask
 */
class SearchTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'title' => $this->title,
            'status' => $this->task_status,
        ];
    }
}
