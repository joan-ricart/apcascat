<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ScheduleTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A test command to verify the scheduler is working.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logFile = 'scheduler-test.log';
        $content = now()->toDateTimeString() . PHP_EOL;

        // This will write to storage/app/scheduler-test.log
        Storage::disk('local')->append($logFile, $content);

        $this->info('Wrote timestamp to ' . $logFile);
    }
}