<?php

namespace App\Imports;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class DepartmentsImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new Department([
            "name" => $row["name"],
            "description" => $row["description"]
        ]);
    }

    public function uniqueBy()
    {
        return 'name';
    }
}
