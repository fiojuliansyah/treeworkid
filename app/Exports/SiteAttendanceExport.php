<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiteAttendanceExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $attendancesByUser;
    protected $dates;
    protected $totalsByUser;

    public function __construct($attendancesByUser, $dates, $totalsByUser)
    {
        $this->attendancesByUser = $attendancesByUser;
        $this->dates = $dates;
        $this->totalsByUser = $totalsByUser;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->attendancesByUser as $user_id => $userAttendances) {
            $user = $userAttendances->first()->user;
            $totals = $this->totalsByUser[$user_id] ?? [
                'totalHK' => 0,
                'totalOvertime' => '0 jam 0 menit',
                'totalBA' => 0,
                'totalLeave' => 0,
            ];

            $row = [$user->name];

            foreach ($this->dates as $date) {
                $attendance = $userAttendances->get($date->format('Y-m-d'));
                if ($attendance) {
                    if ($attendance->leave_id != null) {
                        $row[] = $attendance->leave->type['name'];
                        $row[] = '';
                    } elseif ($attendance->type == 'shift_off') {
                        $row[] = 'OFF';
                        $row[] = '';
                    } else {
                        $row[] = $attendance->clock_in ? $attendance->clock_in->format('H:i') : '-';
                        $row[] = $attendance->clock_out ? $attendance->clock_out->format('H:i') : '-';
                    }
                } else {
                    $row[] = '-';
                    $row[] = '-';
                }
            }

            $row[] = $totals['totalHK'];
            $row[] = $totals['totalOvertime'];
            $row[] = $totals['totalBA'];
            $row[] = $totals['totalLeave'];

            $data[] = $row;
        }

        return collect($data);
    }

    public function headings(): array
    {
        $headings = ['Name'];

        foreach ($this->dates as $date) {
            $headings[] = $date->format('d') . ' IN';
            $headings[] = $date->format('d') . ' OUT';
        }

        $headings = array_merge($headings, [
            'Total HK',
            'Total Lembur',
            'Total BA',
            'Total Cuti'
        ]);

        return $headings;
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A1:Z100')->applyFromArray($styleArray); // Apply styling to range

        // Merge cells for leave and shift-off
        $rowCount = count($this->attendancesByUser) + 1; // Number of rows with data
        $dateCount = $this->dates->count();

        for ($i = 2; $i <= $rowCount; $i++) {
            for ($j = 1; $j <= $dateCount; $j++) {
                $inCell = $sheet->getCellByColumnAndRow($j * 2, $i)->getValue();
                $outCell = $sheet->getCellByColumnAndRow($j * 2 + 1, $i)->getValue();

                if ($inCell === 'OFF' && $outCell === '') {
                    $sheet->mergeCellsByColumnAndRow($j * 2, $i, $j * 2 + 1, $i);
                } elseif ($inCell !== '' && $outCell === '') {
                    $sheet->mergeCellsByColumnAndRow($j * 2, $i, $j * 2 + 1, $i);
                } elseif ($inCell === '' && $outCell === '') {
                    $sheet->mergeCellsByColumnAndRow($j * 2, $i, $j * 2 + 1, $i);
                }
            }
        }

        return [];
    }
}
