<?php

namespace App\Http\Resources\SearchTasks;

use App\Models\FoundUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin FoundUser
 */
class FoundUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'vk_id' => $this->vk_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'is_closed' => (boolean) $this->is_closed,
            'img_url' => $this->img_url,
        ];
    }
}
