<?php

namespace App\Imports;

use App\Models\PermanentContactPoint;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PermanentContactPointsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new PermanentContactPoint([
            'entity_name' => $row["entity_name"],
            'permanent_contact_point_name' => $row["permanent_contact_point_name"],
            'main_email_address' => $row["main_email_address"],
            'secondary_email_address' => $row["secondary_email_address"],
            'main_landline_phone_number' => $row["main_landline_phone_number"],
            'secondary_landline_phone_number' => $row["secondary_landline_phone_number"],
            'main_mobile_phone_number' => $row["main_mobile_phone_number"],
            'secondary_mobile_phone_number' => $row["secondary_mobile_phone_number"],
            'other_alternative_contacts' => $row["other_alternative_contacts"]
        ]);
    }
}
