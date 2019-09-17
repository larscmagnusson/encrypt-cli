<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Decrypt extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'decrypt {--key=} {--key-file=}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $keyFile = $this->option('key-file');
        $CryptoKey = \Defuse\Crypto\Key::loadFromAsciiSafeString(file_get_contents($keyFile));
        $stdin = fopen('php://stdin', 'rb');
        print \Defuse\Crypto\Crypto::decrypt(stream_get_contents($stdin), $CryptoKey);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
