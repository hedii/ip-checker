<?php

namespace Hedii\IpChecker\Notifications;


use Illuminate\Notifications\Notifiable as LaravelNotifiable;

class Notifiable
{
    use LaravelNotifiable;

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail(): string
    {
        return config('ip-checker.notifications.mail.to');
    }

    /**
     * Get the notifiable key.
     *
     * @return string
     */
    public function getKey(): string
    {
        return static::class;
    }
}
