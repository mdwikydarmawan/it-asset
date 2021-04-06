<?php

namespace App\Imports;
use App\ParameterHardware;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use DateTime;

class HardwareImport implements ToModel
{

    /**

    * @param array $row

    *

    * @return \Illuminate\Database\Eloquent\Model|null

    */

    public function model(array $row)
    {

            $infomation = "Nama: ".$row[2]." - Lokasi: ".$row[4]." - Divisi: ".$row[5];
            
            return new ParameterHardware([

                
                    'param_hardware_asset_code'     => $row[1],
                    'param_hardware_name'    => $row[2],
                    'param_hardware_information' => $infomation,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),

            ]);       

    }

}