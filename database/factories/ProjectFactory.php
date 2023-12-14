<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $project_names = [
            'Cv',
            'Portfolio',
            'Clinicoeur',
            'Masaro',
            'Haute-Ecole de Liege',
            'AstromooN',
        ];

        return [
            'title' => $this->faker->randomElement($project_names),
            'description' => $this->faker->text(),
            'link' => $this->faker->url(),
            'tasks' => ['Design', 'Implementation', 'Wordpress'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
