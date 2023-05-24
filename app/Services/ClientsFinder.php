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
        $groups = $this->vkApi->getGroups([
            'q' => $keywords[0],
            'count' => 25,
            'sort' => 6,
        ]);

        $clients = $groups->reduce(function (Collection $carry, $item) use ($params) {
            if ($carry->count() > 2000) {
                return $carry;
            }

            $userParams = [
                ...$params,
                'count' => 1000,
                'group_id' => $item['id']
            ];

            usleep(1 / 3 * 1000000);
            return $carry->concat($this->vkApi->getUsers($userParams)->toArray());
        }, collect());

        return $clients;
    }
}
