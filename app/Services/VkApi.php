<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VkApi
{
    protected PendingRequest $api;
    protected array $baseParams;

    public function __construct()
    {
        $this->api = Http::baseUrl(config('vk.api_url'));

        $this->baseParams = [
            'v' => '5.131'
        ];

        $user = Auth::user();
        if ($user) {
            $this->baseParams['access_token'] = $user->vk_access_token;
        }
    }

    /**
     * @throws RequestException
     */
    public function authorize(string $code): Authenticatable|null|User
    {
        $response = Http::get(config('vk.oauth_url').'/access_token', [
            'client_id' => config('vk.client_id'),
            'client_secret' => config('vk.client_secret'),
            'redirect_uri' => config('vk.redirect_uri'),
            'code' => $code
        ]);

        $response->throwUnlessStatus(200);

        $user = Auth::user();
        $user->update([
            'vk_access_token' => $response->json('access_token')
        ]);

        return $user;
    }

    /**
     * @throws RequestException
     */
    public function getCities(?string $query = null): array|null
    {
        $response = $this->api->get('/database.getCities', [
            'q' => $query,
            'country_id' => 1,
            ...$this->baseParams
        ]);

        $response->throwUnlessStatus(200);

        return $response['response']['items'];
    }

    /**
     * @throws RequestException
     */
    public function getUniversities(int $cityId, ?string $query = null): array|null
    {
        $response = $this->api->get('/database.getUniversities', [
            'q' => $query,
            'city_id' => $cityId,
            ...$this->baseParams
        ]);

        $response->throwUnlessStatus(200);

        return $response['response']['items'];
    }

    /**
     * @throws RequestException
     */
    public function getFaculties(int $universityId): array|null
    {
        $response = $this->api->get('/database.getFaculties', [
            'university_id' => $universityId,
            ...$this->baseParams
        ]);

        $response->throwUnlessStatus(200);

        return $response['response']['items'];
    }

    /**
     * @throws RequestException
     */
    public function getChairs(int $facultyId): array|null
    {
        $response = $this->api->get('/database.getChairs', [
            'faculty_id' => $facultyId,
            ...$this->baseParams
        ]);

        $response->throwUnlessStatus(200);

        return $response['response']['items'];
    }

    /**
     * @throws RequestException
     */
    public function getUsers(array $params): Collection
    {
        $response = $this->api->get('/users.search', [
            ...$params,
            'fields' => config('vk.users.fields'),
            ...$this->baseParams
        ]);

        $response->throwUnlessStatus(200);

        return collect($response['response']['items']);
    }

    /**
     * @throws RequestException
     */
    public function getGroups(array $params): Collection
    {
        $response = $this->api->get('/groups.search', [
            ...$this->baseParams,
            ...$params
        ]);

        $response->throwUnlessStatus(200);

        return collect($response['response']['items']);
    }

    public function setAccessToken(string $token): void
    {
        $this->baseParams['access_token'] = $token;
    }
}
