<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unitTest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run PHP Unit Tests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $timeLimit = 320;
        set_time_limit($timeLimit);

        $process = new Process('vendor'.DIRECTORY_SEPARATOR.'bin'.DIRECTORY_SEPARATOR.'phpunit -c phpunit.xml');
        $process->setWorkingDirectory(base_path());
        $process->setTimeout($timeLimit);

        // outputting the buffer of the command, so we can see it
        return $process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
}
