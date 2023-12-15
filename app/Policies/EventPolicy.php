<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }

    public function update(?User $user, Event $event): bool
    {
        return $user?->id === $event->user_id && $event->status === null;
    }

    public function delete(?User $user, Event $event): bool
    {
        return $user?->id === $event->user_id && $event->status === null;
    }

    public function handleProject(?User $user, Event $event, Project $project): bool
    {
        return $user?->id === $event->user_id && $user?->id === $project->user_id && $event->status === null;
    }

    public function handleContact(?User $user, Event $event, Contact $contact): bool
    {
        return $user?->id === $event->user_id && $user?->id === $contact->user_id && $event->status === null;
    }
}
