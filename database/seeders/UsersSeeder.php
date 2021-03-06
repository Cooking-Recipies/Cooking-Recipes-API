<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
         UserFactory::new()->times(50)->create();
         UserFactory::new()->definition();
    }
}