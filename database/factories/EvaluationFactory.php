<?php

namespace Database\Factories;

use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EvaluationFactory extends Factory
{
    protected $model = Evaluation::class;

    public function definition(): array
    {
        return [
            'score' => $this->faker->randomNumber(),
            'comment' => $this->faker->word(),
            'evaluator_id' => $this->faker->randomNumber(),
            'student_id' => $this->faker->randomNumber(),
            'project_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
