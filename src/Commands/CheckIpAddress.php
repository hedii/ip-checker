<?php

namespace Hedii\IpChecker\Commands;

use Hedii\IpChecker\IpChecker;
use Illuminate\Console\Command;

class CheckIpAddress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ip:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all the ip addresses';

    /**
     * The ip address checker instance.
     *
     * @var \Hedii\IpChecker\IpChecker
     */
    private $checker;

    /**
     * Create a new command instance.
     *
     * @param \Hedii\IpChecker\IpChecker $checker
     */
    public function __construct(IpChecker $checker)
    {
        parent::__construct();

        $this->checker = $checker;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->checker->run();
    }
}
