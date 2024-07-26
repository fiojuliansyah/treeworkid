<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SiteAttendanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents, ShouldAutoSize
{
    use Exportable;

    protected $siteId;
    protected $startDate;
    protected $endDate;

    public function __construct($siteId, $startDate, $endDate)
    {
        $this->siteId = $siteId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return DB::table('attendances')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->where('attendances.site_id', $this->siteId)
            ->whereBetween('attendances.date', [$this->startDate, $this->endDate])
            ->select(
                'attendances.date',
                'users.name as user_name',
                'attendances.clock_in',
                'attendances.clock_out'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            ['Site Attendance Report'],
            ['Date Range: ' . date('F j, Y', strtotime($this->startDate)) . ' - ' . date('F j, Y', strtotime($this->endDate))],
            ['User', 'IN', 'OUT'],
        ];
    }

    public function map($row): array
    {
        return [
            $row->user_name,
            $row->clock_in,
            $row->clock_out,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:C3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Merge cells for date range
        $sheet->mergeCells('A1:C1');
        $sheet->mergeCells('A2:C2');
    }

    public function registerEvents(): array
    {
        return [
            // Add any events you need to customize here
        ];
    }
}
