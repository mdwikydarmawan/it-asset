<?php
 
namespace App\Exports;
 
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PKSExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $ba_pks = DB::table('ba_pks')                            
                            ->select(   'param_pks.pks_type',
                            			'param_vendor.vendor_name',
                            			'ba_pks.pks_name',
                                        'ba_pks.pks_number',
                                        'ba_pks.pks_date',
                                        'ba_pks.pks_date_start',
                                        'ba_pks.pks_date_end',
                                        'ba_pks.fee',                                        
                                        'param_status.status_name'
                                    )  
                            ->join('param_vendor', 'param_vendor.id', '=', 'ba_pks.vendor_id')
                            ->join('param_pks', 'param_pks.id', '=', 'ba_pks.pks_type_id')
                            ->join('param_status', 'param_status.id', '=', 'ba_pks.status')
                            ->orderBy("ba_pks.pks_name", "ASC")
                            ->get();

        return $ba_pks;
    }

    public function headings(): array
    {
        return ["Jenis PKS", "Nama Vendor", "Nama PKS", "Nomor PKS", "Tanggal PKS", "Tanggal PKS Awal", "Tanggal PKS Akhir", "Biaya", "Status"];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:I1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

}

?>