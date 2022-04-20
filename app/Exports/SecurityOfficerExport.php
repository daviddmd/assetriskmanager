<?php

namespace App\Exports;

use App\Models\SecurityOfficer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SecurityOfficerExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SecurityOfficer::all();
    }

    public function headings(): array
    {
        return [
            'Entity Name',
            'Name',
            "Role",
            'Email Address',
            'Landline Phone Number',
            'Mobile Phone Number',
        ];
    }

    public function map($row): array
    {
        return [
            $row->entity_name,
            $row->name,
            $row->role,
            $row->email_address,
            $row->landline_phone_number,
            $row->mobile_phone_number,
        ];
    }
}
