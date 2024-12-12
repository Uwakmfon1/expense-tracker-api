<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\API\ExpenseCategorySeeder;
use Database\Seeders\API\IncomeCategorySeeder;
use Database\Seeders\API\ParentCategorySeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         User::factory(10)->create();

//        User::factory()->create([
//            ['name' => 'Test User',
//            'email' => 'test@example.com',],
//            [
//                'name'=>'John Doe',
//                'email'=>'johndoe1@ex.com'
//            ]
//        ]);

        $this->call([
            ParentCategorySeeder::class,
            ExpenseCategorySeeder::class,
            IncomeCategorySeeder::class
        ]);
    }
}
