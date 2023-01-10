<?php

namespace App\Imports;

use App\Models\SecurityOfficer;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SecurityOfficersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new SecurityOfficer([
            'entity_name' => $row["entity_name"],
            'name' => $row["name"],
            'role' => $row["role"],
            'email_address' => $row["email_address"],
            'landline_phone_number' => $row["landline_phone_number"],
            'mobile_phone_number' => $row["mobile_phone_number"]
        ]);
    }
}
