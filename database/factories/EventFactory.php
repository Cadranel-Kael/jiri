<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $date = Carbon::createFromDate(rand(2020, 2025), rand(1, 12), rand(1, 30), 0);
        if ($date->isPast()) {
            $status = 'ended';
        } else {
            $status = null;
        }

        return [
            'name' => $this->faker->word(),
            'date' => $date,
            'status' => $status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
