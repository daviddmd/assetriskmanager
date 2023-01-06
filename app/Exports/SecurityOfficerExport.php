<?php

namespace App\Exports;

use App\Models\SecurityOfficer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SecurityOfficerExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return SecurityOfficer::all();
    }

    public function headings(): array
    {
        return [
            'Nome da Entidade',
            'Nome do Responsável de Segurança',
            "Cargo do Responsável de Segurança",
            'Endereço de Correio Eletrónico',
            'Número de Telefone Fixo',
            'Número de Telefone Móvel',
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

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
