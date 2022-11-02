<?php

namespace App\Exports\Alumni;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniBekerjaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'NIM',
            'Tanggal Mulai',
            'Nama Instansi',
            'Jenis Pekerjaan',
            'Jenis Perusahaan',
        ];
    }
}