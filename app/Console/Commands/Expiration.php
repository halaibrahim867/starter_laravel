<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire'; ///command name

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire user every 5 minutes automatically';

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
     * @return int
     */
    public function handle()
    {
        $users=User::where('expire', 0)-> get(); // return collections of users that i'll loop on them

        foreach ($users as $user){
            $user -> update(['expire'=> 1]);
        }

    }
}
