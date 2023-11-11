<?php

namespace Database\Factories;

use App\Models\Participation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ParticipationFactory extends Factory
{
    protected $model = Participation::class;


    public function definition(): array
    {
        $scores = [];
        $comments = [];
        for ($i = 0; $i < rand(1,5); $i++) {
            $jury = rand(0,50);
            $scores[] = [$jury, rand(0,20)];
            $comments[] = [$jury, $this->faker->words()];
        }

        $urls = [];
        for ($j = 0; $j < 4; $j++) {
            $urls[] = $this->faker->url();
        }

        return [
            'contact_id' => rand(1,100),
            'project_id' => rand(1,10),
            'score' => $scores,
            'comments' => $comments,
            'urls' => $urls,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
