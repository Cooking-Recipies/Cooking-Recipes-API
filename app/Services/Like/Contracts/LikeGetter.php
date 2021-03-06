<?php

namespace App\Services\Like\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Rennokki\Befriended\Contracts\Liker;

interface LikeGetter
{
    public function getPaginated(Liker $liker, ?string $perPage, string $modelClassName): LengthAwarePaginator;
}