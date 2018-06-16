<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('threads.index'));
});

// Home > User

Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push('User', url('/'));
});

// Home > User > [profile]
Breadcrumbs::for('profile', function ($trail, $user) {
    $trail->parent('user');
    $trail->push($user->name, route('profile.show', $user->name));
});

// Home > [Channel]
Breadcrumbs::for('channel', function ($trail, $channel) {
    $trail->parent('home');
    $trail->push($channel->name, route('channels.index', $channel->slug));
});

// Home > [Channel] > [Thread]

Breadcrumbs::for('thread', function ($trail, $thread) {
    $trail->parent('channel', $thread->channel);
    $trail->push($thread->title, route('threads.show', [$thread->channel->slug, $thread->id]));
});

// Home > Create

Breadcrumbs::for('create', function ($trail) {
    $trail->parent('home');
    $trail->push('Create', route('threads.create'));
});

// Home > 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->parent('home');
    $trail->push('Page Not Found');
});
