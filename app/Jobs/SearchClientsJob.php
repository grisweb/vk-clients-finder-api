<?php

namespace App\Jobs;

use App\Models\FoundUser;
use App\Models\SearchTask;
use App\Services\ClientsFinder;
use App\Services\VkApi;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Throwable;

class SearchClientsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 300;

    protected int $searchTaskId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $searchTaskId)
    {
        $this->searchTaskId = $searchTaskId;
    }

    /**
     * Execute the job.
     */
    public function handle(ClientsFinder $clientsFinder, VkApi $vkApi): void
    {
        $task = SearchTask::where('id', $this->searchTaskId)->with('user')->first();
        $taskParams = $task->getUrlParams();

        $vkApi->setAccessToken($task->user->vk_access_token);

        try {
            $clients = $clientsFinder->find($taskParams, $task->getAttribute('keywords')['*']);

            $clients->each(function ($item) use ($task) {
                $attributes = [
                    'uuid' => Str::uuid(),
                    'vk_id' => $item['id'],
                    'task_id' => $task->id,
                    'first_name' => $item['first_name'],
                    'last_name' => $item['last_name'],
                    'is_closed' => (boolean) $item['is_closed'],
                    'img_url' => $item['photo_50']
                ];

                if (isset($item['last_seen'])) {
                    $attributes['last_seen'] = date('d.m.y H:i', $item['last_seen']['time']);
                }

                FoundUser::create($attributes);
            });

            $task->update([
                'task_status' => 'completed'
            ]);
        } catch (Throwable $e) {
            $task->update([
                'task_status' => 'error'
            ]);

            $this->fail($e);
        }
    }
}
