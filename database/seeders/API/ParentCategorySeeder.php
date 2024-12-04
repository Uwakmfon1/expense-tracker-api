<?php

namespace Database\Seeders\API;

use App\Models\ParentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParentCategory::insert([
            [
                'name'=>'Expense',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Income',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
            ]);
    }
}
