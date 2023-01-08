<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Display2FA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'display:2fa {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays the 2FA Codes of an User';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where("email", "=", $this->argument("email"))->first();
        if ($user && $user->hasEnabledTwoFactorAuthentication()) {
            $recovery_codes = $user->recoveryCodes();
            foreach ($recovery_codes as $recovery_code){
                $this->info($recovery_code);
            }
            return CommandAlias::SUCCESS;
        }
        return CommandAlias::FAILURE;
    }
}
