<?php

namespace Hedii\IpChecker\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IpAddressIsFailing extends Notification
{
    use Queueable;

    /**
     * The ip address that is failing.
     *
     * @var string
     */
    public $ip;

    /**
     * The application server name.
     *
     * @var string
     */
    public $serverName;

    /**
     * Create a new notification instance.
     *
     * @param string $ip
     */
    public function __construct(string $ip)
    {
        $this->ip = $ip;
        $this->serverName = config('ip-checker.server_name');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->error()
            ->line("Ip address {$this->ip} is failing on server {$this->serverName}.");
    }
}
