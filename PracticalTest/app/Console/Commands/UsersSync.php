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
        dispatch(new JobsSync());
        $this->call('queue:work', [
            '--once' => true
        ]);
    }
}
