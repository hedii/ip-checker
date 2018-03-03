<?php

namespace Hedii\IpChecker\Test;

use Hedii\IpChecker\IpChecker;
use Hedii\IpChecker\Notifications\IpAddressIsFailing;
use Hedii\IpChecker\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;

class IpCheckerTest extends TestCase
{
    /** @test */
    public function it_should_send_a_notification_if_the_check_fails(): void
    {
        Notification::fake();

        Config::set('ip-checker.ips', ['0.0.0.0', '123.123.123.123']);

        $this->app[IpChecker::class]->run();

        Notification::assertSentTo(
            new Notifiable(),
            IpAddressIsFailing::class,
            function ($notification) {
                return $notification->ip === '123.123.123.123';
            }
        );
    }

    /** @test */
    public function it_should_not_send_a_notification_if_the_check_succeed(): void
    {
        Notification::fake();

        Config::set('ip-checker.ips', ['0.0.0.0']);

        $this->app[IpChecker::class]->run();

        Notification::assertNotSentTo(new Notifiable(), IpAddressIsFailing::class);
    }
}
