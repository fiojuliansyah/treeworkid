<?php

namespace App\Imports;

use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiteImport implements ToModel, WithHeadingRow
{
    /**
     * Method to map the Excel data to the Site model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Map the Excel row to the Site model fields and return a new instance of the Site model
        return new Site([
            'company_id' => $row['company_id'],        // Column name from the Excel header
            'name' => $row['name'],                    // Column name from the Excel header
            'description' => $row['description'],      // Column name from the Excel header
            'lat' => $row['lat'],                      // Column name from the Excel header
            'long' => $row['long'],                    // Column name from the Excel header
            'radius' => $row['radius'],                // Column name from the Excel header
            'client_name' => $row['client_name'],      // Column name from the Excel header
            'client_phone' => $row['client_phone'],    // Column name from the Excel header
            'client_email' => $row['client_email'],    // Column name from the Excel header
        ]);
    }
}
