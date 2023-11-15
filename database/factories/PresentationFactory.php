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
        $scores = [];
        for ($i = 0; $i < rand(1,5); $i++) {
            $jury = rand(0,50);
            $scores[] = [$jury, rand(0,20), $this->faker->text(100)];
        }

        $urls = [];
        for ($j = 0; $j < 4; $j++) {
            $urls[] = $this->faker->url();
        }

        $tasks = ['Design', 'Implementation', 'Wordpress'];
        for ($i = 0; $i < rand(0,2); $i++) {
            array_pop($tasks);
        }

        return [
            'contact_id' => rand(1,100),
            'project_id' => rand(1,10),
            'scores' => json_encode($scores),
            'urls' => json_encode($urls),
            'tasks' => json_encode($tasks),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
