<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ResetRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:role {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the role of an User';

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
                "role" => UserRole::ASSET_MANAGER
            ]);
            $this->info("User role Reset.");
            return CommandAlias::SUCCESS;
        }
        $this->error("No user with such email found.");
        return CommandAlias::FAILURE;
    }
}
