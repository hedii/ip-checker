<?php

namespace Hedii\IpChecker\Listeners;

use Hedii\IpChecker\Events\IpAddressCheckFailedEvent;
use Hedii\IpChecker\Notifications\IpAddressIsFailing;
use Hedii\IpChecker\Notifications\Notifiable;

class SendIpAddressIsFailingNotification
{
    /**
     * The notifiable instance.
     *
     * @var \Hedii\IpChecker\Notifications\Notifiable
     */
    private $notifiable;

    /**
     * SendIpAddressIsFailingNotification constructor.
     *
     * @param \Hedii\IpChecker\Notifications\Notifiable $notifiable
     */
    public function __construct(Notifiable $notifiable)
    {
        $this->notifiable = $notifiable;
    }

    /**
     * Handle the event.
     *
     * @param \Hedii\IpChecker\Events\IpAddressCheckFailedEvent $event
     */
    public function handle(IpAddressCheckFailedEvent $event): void
    {
        $this->notifiable->notify(new IpAddressIsFailing($event->ip));
    }
}
