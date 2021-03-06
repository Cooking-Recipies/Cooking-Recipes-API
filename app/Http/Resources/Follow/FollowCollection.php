<?php

namespace App\Http\Resources\Follow;

use App\Http\Resources\PaginatedCollection;

class FollowCollection extends PaginatedCollection
{
    public function toArray($request): array
    {
        return [
            "data" => FollowResource::collection($this->collection),
        ];
    }
}