<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\UsersSync as JobsSync;
use Symfony\Component\Process\Process;

class UsersSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to sync users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $process = new Process(['php', 'artisan', 'queue:work']);
        // $process->setTimeout(60); // Set the timeout as needed

        // try {
        //     $process->run();
        // } catch (ProcessFailedException $exception) {
        //     // Handle any process execution errors
        //     $this->error('Failed to run queue worker: ' . $exception->getMessage());
        //     return;
        // }

        // // Process output, if needed
        // $output = $process->getOutput();

        // return $output;
        dispatch(new JobsSync());
    }
}
