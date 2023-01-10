<?php

namespace App\Imports;

use App\Enums\UserRole;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UsersImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        $department_ids = Department::all()->pluck("id")->toArray();
        $name = $row["name"];
        $email = $row["email"];
        $password = $row["password"];
        $password = empty($password) ? Hash::make(config("constants.default_password")) : Hash::make($password);
        $department_id = (int)$row["department_id"];
        $department_id = in_array($department_id, $department_ids) ? $department_id : null;
        $active = $row["active"];
        $active = (bool)filter_var($active, FILTER_VALIDATE_BOOLEAN);
        $role = $row["role"];
        $role = empty($role) || !UserRole::tryFrom($role) ? UserRole::ASSET_MANAGER : $role;
        return new User([
            'name' => $name,
            "email" => $email,
            "password" => $password,
            'department_id' => $department_id,
            "active" => $active,
            "role" => $role,
        ]);
    }

    public function uniqueBy()
    {
        return 'email';
    }
}
