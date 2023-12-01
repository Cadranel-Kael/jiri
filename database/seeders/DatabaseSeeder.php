<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Presentation;
use App\Models\Project;
use App\Models\EventsProject;
use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);

        $contacts = Contact::factory()->count(100)->create(
            [
                'user_id' => $user->id,
            ]
        );

        $events = Event::factory()->count(10)->create(
            [
                'user_id' => $user->id,
            ]
        );

        $projects = Project::factory()->count(10)->create(
            [
                'user_id' => $user->id,
            ]
        );

        foreach ($events as $event) {
            for ($i = 0; $i < 3; $i++) {
                EventsProject::factory()->create(
                    [
                        'event_id' => $event->id,
                        'project_id' => $projects->random()->id,
                    ]
                );
            }
        }

        foreach ($events->where('status', 'ended') as $event) {
            $students = $contacts->random(10);
            $evaluators = $contacts->whereNotIn('id', $students->pluck('id'))->random(10);

            foreach ($students as $student) {
                Participant::factory()->create([
                    'event_id' => $event->id,
                    'contact_id' => $student->id,
                    'role' => 'student',
                ]);
            }

            foreach ($evaluators as $evaluator) {
                Participant::factory()->create([
                    'event_id' => $event->id,
                    'contact_id' => $evaluator->id,
                    'role' => 'evaluator',
                ]);
            }
        }

        foreach ($events as $event) {
            $projects = $event->projects;

            foreach ($event->students as $student) {
                foreach ($projects as $project) {
                    Presentation::factory()->create([
                        'event_id' => $event->id,
                        'project_id' => $project->id,
                        'contact_id' => $student->id,
                    ]);
                }
            }

            foreach ($event->evaluators as $evaluator) {
                foreach ($event->presentations as $presentation) {
                    Score::factory()->create([
                        'presentation_id' => $presentation->id,
                        'contact_id' => $evaluator->id,
                    ]);
                }
            }
        }
    }
}
