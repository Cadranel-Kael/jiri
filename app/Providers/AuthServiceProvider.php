<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('handle-contact', function (User $user, Contact $contact) {
            return $contact->user_id === $user->id;
        });

        Gate::define('handle-event', function (User $user, Event $event) {
            return $event->user_id === $user->id;
        });

        Gate::define('handle-project', function (User $user, Project $project) {
            return $project->user_id === $user->id;
        });
    }
}
