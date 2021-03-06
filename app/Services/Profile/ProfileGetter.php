<?php

namespace App\Services\Profile;

use App\Services\Profile\Contracts\ProfileGetter as Getter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Profile;

class ProfileGetter implements Getter
{
    public function getPaginated(?string $name, ?string $perPage): LengthAwarePaginator
    {
        return Profile::query()
            ->where("name", "like", "%{$name}%")
            ->paginate($perPage);
    }
}