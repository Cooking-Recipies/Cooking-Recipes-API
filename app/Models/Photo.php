<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Photo extends Model implements UserResource
{
    protected $table = "photos";

    protected $fillable = [
        "path",
        "user_id",
    ];

    public function getIncrementing()
    {
        return false;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photosOnRecipes(): HasMany
    {
        return $this->hasMany(PhotoOnRecipe::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($photo): void {
            $photo->{$photo->getKeyName()} = (string)Str::uuid();
        });
    }
}