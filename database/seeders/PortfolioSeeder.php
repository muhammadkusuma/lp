<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        
        if ($projects->isEmpty()) {
            $this->command->warn('No projects found. Please run ProjectSeeder first.');
            return;
        }

        $portfolios = [];

        foreach ($projects as $project) {
            $portfolios[] = [
                'id' => \Illuminate\Support\Str::uuid(),
                'project_id' => $project->id,
                'title' => 'Portfolio: ' . $project->name,
                'description' => 'Showcase of project ' . $project->name . ' developed for our client.',
                'image_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('portfolios')->insert($portfolios);

        $this->command->info('Portfolios seeded successfully!');
    }
}
