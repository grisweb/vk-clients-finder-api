<?php

namespace App\Http\Resources\SearchTasks;

use App\Models\SearchTask;
use App\Repositories\SearchTaskRepository;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin SearchTask
 */
class SearchTaskResource extends JsonResource
{
    protected SearchTaskRepository $taskRepository;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->taskRepository = app(SearchTaskRepository::class);
    }

    /**
     * Transform the resource into an array.
     *
     *
     * @return array<string, mixed>
     * @throws RequestException
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'title' => $this->title,
            'status' => $this->task_status,
            'params' => $this->taskRepository->getTaskParams($this->resource)
        ];
    }
}
