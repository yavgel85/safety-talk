<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            [
                'id'   => 1,
                'name' => 'Safety talk',
            ],
            [
                'id'   => 2,
                'name' => 'Accident report',
            ],
            [
                'id'   => 3,
                'name' => 'Formation talk',
            ],
            [
                'id'   => 4,
                'name' => 'Others',
            ],
        ];

        Category::insert($categories);
    }
}
