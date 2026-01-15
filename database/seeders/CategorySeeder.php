<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development'],
            ['name' => 'Mobile Development'],
            ['name' => 'UI/UX Design'],
            ['name' => 'Digital Marketing'],
            ['name' => 'Cloud Computing'],
            ['name' => 'Cybersecurity'],
            ['name' => 'Artificial Intelligence'],
            ['name' => 'Tips & Tutorial'],
            ['name' => 'Company News'],
            ['name' => 'Case Study'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('Categories seeded successfully!');
    }
}
