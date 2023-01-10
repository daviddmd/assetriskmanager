<?php

namespace App\Imports;

use App\Models\AssetType;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class AssetTypesImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new AssetType([
            "name" => $row["name"]
        ]);
    }

    public function uniqueBy()
    {
        return 'name';
    }
}
