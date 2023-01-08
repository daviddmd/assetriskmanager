<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Reset2FA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:2fa {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes 2FA from the account of an User';

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
                "two_factor_confirmed_at" => null,
                "two_factor_recovery_codes" => null,
                "two_factor_secret" => null
            ]);
            return CommandAlias::SUCCESS;
        }
        return CommandAlias::FAILURE;
    }
}
