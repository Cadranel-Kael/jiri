<?php


use App\Models\User;
use function Pest\Laravel\actingAs;

it('shows only the users events and not other users events', function () {

    $user1 = User::factory()
        ->hasEvents(1, [
            'name' => 'User1 event'
        ])
        ->create();

    $user2 = User::factory()
        ->hasEvents(1, [
            'name' => 'User2 event'
        ])
        ->create();

    actingAs($user1)
        ->get(route('dashboard'))
        ->assertDontSee('User2 event')
        ->assertSee('User1 event');
});

it('only shows future events', function () {

    $user1 = User::factory()
        ->hasEvents(1, [
            'name' => 'old event',
            'date' => \Carbon\Carbon::createFromDate('2020'),
        ])->hasEvents(1, [
            'name' => 'new event',
            'date' => \Carbon\Carbon::now(),
        ])
        ->create();

    actingAs($user1)
        ->get(route('dashboard'))
        ->assertDontSee('old event')
        ->assertSee('new event');
});
