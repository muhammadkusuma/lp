<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        $posts = Post::all();
        $categories = Category::all();
        
        if ($posts->isEmpty() || $categories->isEmpty()) {
            $this->command->warn('No posts or categories found. Please run PostSeeder and CategorySeeder first.');
            return;
        }

        // Assign categories to posts
        $webDev = $categories->where('name', 'Web Development')->first();
        $mobileDev = $categories->where('name', 'Mobile Development')->first();
        $security = $categories->where('name', 'Cybersecurity')->first();
        $tips = $categories->where('name', 'Tips & Tutorial')->first();

        foreach ($posts as $post) {
            // Assign 1-3 random categories to each post
            $randomCategories = $categories->random(rand(1, 3))->pluck('id')->toArray();
            $post->categories()->attach($randomCategories);
        }

        $this->command->info('Post categories linked successfully!');
    }
}
