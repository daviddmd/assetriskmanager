<?php

namespace App\Exports;

use App\Models\PermanentContactPoint;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PermanentContactPointExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return PermanentContactPoint::all();
    }

    public function map($row): array
    {
        return [
            $row->entity_name,
            $row->permanent_contact_point_name,
            $row->main_email_address,
            $row->secondary_email_address,
            $row->main_landline_phone_number,
            $row->secondary_landline_phone_number,
            $row->main_mobile_phone_number,
            $row->secondary_mobile_phone_number,
            $row->other_alternative_contacts,
        ];
    }

    public function headings(): array
    {
        return [
            'Entity Name',
            'Permanent Contact Point Name',
            'Main Email Address',
            'Secondary Email Address',
            'Main Landline Phone Number',
            'Secondary Landline Phone Number',
            'Main Mobile Phone Number',
            'Secondary Mobile Phone Number',
            'Other Alternative Contacts',
        ];
    }
}
