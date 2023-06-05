<?php

namespace App\Repositories;

use App\Models\SearchTask;
use App\Services\VkApi;
use Illuminate\Http\Client\RequestException;

class SearchTaskRepository
{
    protected VkApi $vkApi;

    public function __construct(VkApi $vkApi)
    {
        $this->vkApi = $vkApi;
    }

    /**
     * @throws RequestException
     */
    public function getTaskParams(SearchTask $searchTask): array
    {
        $result = [];

        if ($searchTask->city) {
            $result['city'] = $this->vkApi->getCity($searchTask->city);
        }

        $result = [
            'age_from' => $searchTask->age_from,
            'age_to' => $searchTask->age_to,
            'birth_day' => $searchTask->birth_day,
            'birth_month' => $searchTask->birth_month,
            'birth_year' => $searchTask->birth_year,
            'sex' => $searchTask->sex,
            'status' => $searchTask->status,
            'has_photo' => $searchTask->has_photo,
            'keywords' => $searchTask->keywords['*'],
            ...$result
        ];

        return collect($result)->filter()->toArray();
    }
}
