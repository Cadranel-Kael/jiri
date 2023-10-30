<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
        ]);

        Contact::factory()->count(100)->create();

        Event::factory()->count(30)->create();
    }
}
