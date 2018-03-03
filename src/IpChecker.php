<?php

namespace Hedii\IpChecker;

use Exception;
use GuzzleHttp\Client;
use Hedii\IpChecker\Events\IpAddressCheckFailedEvent;
use Illuminate\Config\Repository;
use Illuminate\Support\Arr;

class IpChecker
{
    /**
     * The configuration repository instance.
     *
     * @var \Illuminate\Config\Repository
     */
    private $config;

    /**
     * IpChecker constructor.
     *
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Run the ip checker against all ip addresses.
     */
    public function run(): void
    {
        foreach ($this->ips() as $ip) {
            if (! $this->check($ip)) {
                IpAddressCheckFailedEvent::dispatch($ip);
            }
        }
    }

    /**
     * Check an ip address.
     *
     * @param string $ip
     * @return bool
     */
    private function check(string $ip): bool
    {
        try {
            $this->client($ip)->get($this->url());

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get all the ip addresses to check.
     *
     * @return array
     */
    private function ips(): array
    {
        return $this->config->get('ip-checker.ips');
    }

    /**
     * Get all the test urls.
     *
     * @return array
     */
    private function urls(): array
    {
        return $this->config->get('ip-checker.test_urls');
    }

    /**
     * Get a random test url.
     *
     * @return string
     */
    private function url(): string
    {
        return Arr::random($this->urls());
    }

    /**
     * Get an http client setup with a given outgoing ip address.
     *
     * @param string $ip
     * @return \GuzzleHttp\Client
     */
    private function client(string $ip): Client
    {
        return new Client([
            'connect_timeout' => 10,
            'timeout' => 30,
            'verify' => false,
            'curl' => [CURLOPT_INTERFACE => $ip]
        ]);
    }
}
