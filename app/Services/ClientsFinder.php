<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class ClientsFinder
{
    protected VkApi $vkApi;

    public function __construct(VkApi $vkApi)
    {
        $this->vkApi = $vkApi;
    }

    /**
     * @throws RequestException
     */
    public function find(array $params, array $keywords): Collection
    {
        $groups = collect();

        foreach ($keywords as $keyword) {
            $groups = $groups->concat($this->vkApi->getGroups([
                'q' => $keyword,
                'count' => 5,
                'sort' => 6,
            ])->toArray());
        }

        $clients = $groups->reduce(function (Collection $carry, $item) use ($params) {
            if ($carry->count() > 5000) {
                return $carry;
            }

            $userParams = [
                ...$params,
                'count' => 500,
                'group_id' => $item['id']
            ];

            usleep(1 / 3 * 1000000);
            return $carry->concat($this->vkApi->getUsers($userParams)->toArray());
        }, collect());

        $clients = collect($clients)->unique(function ($item) {
            return $item['id'];
        })->sortByDesc(function (array $client) {
            return $client['last_seen'] ?? 0;
        });

        return $clients;
    }
}
