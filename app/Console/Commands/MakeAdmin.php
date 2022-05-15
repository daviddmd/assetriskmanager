<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grant an User of the Platform the Administrator Role';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $user = User::where("email", "=", $this->argument("email"))->first();
        $user?->update([
            "role" => UserRole::ADMINISTRATOR
        ]);
        return 0;
    }
}
