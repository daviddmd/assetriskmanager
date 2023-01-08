<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run()
    {
        $users = User::factory()->count(10)->create();
        $users[0]->update(["role" => UserRole::ADMINISTRATOR, "department_id" => 7, "language" => "pt"]);
        $users[1]->update(["role" => UserRole::SECURITY_OFFICER, "department_id" => 10, "language" => "pt"]);
        $users[2]->update(["role" => UserRole::DATA_PROTECTION_OFFICER, "department_id" => 10, "language" => "pt"]);
        foreach (range(3, 9) as $userId) {
            $users[$userId]->update(["department_id" => random_int(1, 11)]);
        }
    }
}
