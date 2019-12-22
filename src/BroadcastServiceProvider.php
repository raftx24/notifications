<?php

namespace LaravelEnso\Notifications;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Broadcast::channel($this->channel(), fn($user, $id) => (
            (int) $user->id === (int) $id
        ));
    }

    private function channel()
    {
        return collect(
            explode('\\', config('auth.providers.users.model'))
        )->push('{id}')->implode('.');
    }
}
