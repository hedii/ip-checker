<?php

namespace Hedii\IpChecker\Events;

use Illuminate\Foundation\Events\Dispatchable;

class IpAddressCheckFailedEvent
{
    use Dispatchable;

    /**
     * The ip address that has not passed the check.
     *
     * @var string
     */
    public $ip;

    /**
     * IpAddressCheckFailedEvent constructor.
     *
     * @param string $ip
     */
    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }
}
