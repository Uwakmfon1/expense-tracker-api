<?php

namespace Database\Seeders\API;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Housing',                          'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Transportation',                   'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Food and Groceries',               'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Health and Wellness',              'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Debt and Savings',                 'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Entertainment and Recreation',     'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Education and Training',           'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Family and Relationship',          'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Shopping',                         'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Insurance',                        'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Charity and Donations',            'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
              ['user_id'=>Auth::id(), 'parent_category_id'=>1,'name' => 'Miscellaneous',                    'type'=>'expense', 'image_url'=>'random.jpg','description'=>'null' ,'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
