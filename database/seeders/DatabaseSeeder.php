<?php

namespace Database\Seeders;

use App\Models\Rate;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if(User::query()->get()->isEmpty())
        {
            $this->call([
                UsersSeeder::class,
                ProfilesSeeder::class,
                FollowSeeder::class,
            ]);
        }

        if(Category::query()->get()->isEmpty())
        {
            $this->call(CategoriesSeeder::class);
        }

        if(Recipe::query()->get()->isEmpty())
        {
            $this->call([
                ComponentsSeeder::class,
                TagsSeeder::class,
                RecipeSeeder::class,
                LikesSeeder::class,
            ]);
        }

        if(Rate::query()->get()->isEmpty())
        {
            $this->call([
                RatesSeeder::class,
            ]);
        }
    }
}
