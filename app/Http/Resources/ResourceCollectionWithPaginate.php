<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @mixin LengthAwarePaginator
 */
class ResourceCollectionWithPaginate extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function pagination(): array
    {
        return [
            'current_page' => $this->currentPage(),
            'per_page' => $this->perPage(),
            'count' => $this->count(),
            'total' => $this->total()
        ];
    }
}
