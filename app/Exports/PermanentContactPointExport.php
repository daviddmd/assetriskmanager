<?php

namespace App\Exports;

use App\Models\PermanentContactPoint;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PermanentContactPointExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
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
            $row->main_mobile_phone_number,
            $row->secondary_landline_phone_number,
            $row->secondary_mobile_phone_number,
            $row->other_alternative_contacts,
        ];
    }

    public function headings(): array
    {
        return [
            'Nome da Entidade',
            'Nome do ponto ou pontos de contacto permanente / serviço disponível ou equipa operacional',
            'Endereço de Correio Eletrónico Principal',
            'Endereço de Correio Eletrónico Alternativo',
            'Número de Telefone Fixo Principal',
            'Número de Telefone Móvel Principal',
            'Número de Telefone Fixo Alternativo',
            'Número de Telefone Móvel Alternativo',
            'Outros Contactos Alternativos',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
