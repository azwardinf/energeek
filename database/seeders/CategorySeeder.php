<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            'name' => 'To Do',
        ];

        Category::create($category);

        $category = [
            'name' => 'In Progress',
        ];

        Category::create($category);

        $category = [
            'name' => 'Testing',
        ];

        Category::create($category);

        $category = [
            'name' => 'Done',
        ];

        Category::create($category);

        $category = [
            'name' => 'Pending',
        ];

        Category::create($category);
    }
}
