<?php

namespace Database\Factories;

use App\Models\Score;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ScoreFactory extends Factory
{
    protected $model = Score::class;

    public function definition(): array
    {
        return [
            'score' => $this->faker->numberBetween(0,100),
            'comment' => $this->faker->text(100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
