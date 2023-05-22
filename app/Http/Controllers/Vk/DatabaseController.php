<?php

namespace App\Http\Controllers\Vk;

use App\Http\Controllers\Controller;
use App\Http\Requests\VkDatabase\GetChairsRequest;
use App\Http\Requests\VkDatabase\GetCitiesRequest;
use App\Http\Requests\VkDatabase\GetFacultiesRequest;
use App\Http\Requests\VkDatabase\GetUniversitiesRequest;
use App\Services\VkApi;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;

class DatabaseController extends Controller
{
    /**
     * @throws RequestException
     */
    public function getCities(GetCitiesRequest $request, VkApi $vkApi): JsonResponse
    {
        $cities = $vkApi->getCities($request->get('q'));
        return $this->response($cities);
    }

    /**
     * @throws RequestException
     */
    public function getUniversities(GetUniversitiesRequest $request, VkApi $vkApi): JsonResponse
    {
        $universities = $vkApi->getUniversities($request->get('city'), $request->get('q'));
        return $this->response($universities);
    }

    /**
     * @throws RequestException
     */
    public function getFaculties(GetFacultiesRequest $request, VkApi $vkApi): JsonResponse
    {
        $faculties = $vkApi->getFaculties($request->get('university'));
        return $this->response($faculties);
    }

    /**
     * @throws RequestException
     */
    public function getChairs(GetChairsRequest $request, VkApi $vkApi): JsonResponse {
        $chairs = $vkApi->getChairs($request->get('faculty'));
        return $this->response($chairs);
    }
}
