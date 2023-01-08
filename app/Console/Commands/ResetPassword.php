<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:password {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the Password of an User';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where("email", "=", $this->argument("email"))->first();
        if ($user) {
            $user->update([
                "password" => \Hash::make($this->argument("password"))
            ]);
            $this->info("User Password Updated.");
            return CommandAlias::SUCCESS;
        }
        $this->error("No user with such email found.");
        return CommandAlias::FAILURE;
    }
}
