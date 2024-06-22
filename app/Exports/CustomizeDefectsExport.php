<?php

namespace App\Exports;

use App\Models\Defect;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CustomizeDefectsExport implements FromCollection, WithHeadings, WithCustomStartCell, ShouldAutoSize
{
    protected $defects;

    public function __construct($defects)
    {
        $this->defects = $defects;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->defects;
    }

    public function headings(): array
    {
        return [
            'Size',
            'Pattern',
            'Item Code',
            'Defect',
            'Qty',
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    /**
     * @param AfterSheet $event
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Tambahkan header kustom di atas heading tabel
                $sheet->setCellValue('A1', 'Custom Header: Defect Report');
                $sheet->mergeCells('A1:E1');

                // Atur style untuk header kustom
                $sheet->getStyle('A1:E1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['argb' => 'FFFFFF']
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '4CAF50']
                    ]
                ]);

                // Atur style untuk heading tabel agar rata tengah
                $sheet->getStyle('A3:E3')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            },
        ];
    }
}