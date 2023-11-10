<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProjectsEventsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => rand(1,10),
            'event_id' => rand(1,10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
