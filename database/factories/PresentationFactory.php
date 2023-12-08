<?php

namespace Database\Factories;

use App\Models\Presentation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PresentationFactory extends Factory
{
    protected $model = Presentation::class;


    public function definition(): array
    {
        $urls = [];
        for ($j = 0; $j < 4; $j++) {
            $urls[] = $this->faker->url();
        }

        $tasks = ['Design', 'Implementation', 'Wordpress'];
        for ($i = 0; $i < rand(0,2); $i++) {
            array_pop($tasks);
        }

        return [
            'urls' => $urls,
            'tasks' => $tasks,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
