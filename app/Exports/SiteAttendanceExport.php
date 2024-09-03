<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SiteAttendanceExport implements FromCollection, WithHeadings, WithStyles
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
        // Set the header row style
        $headerRow = '1';
        $sheet->getStyle($headerRow)->getFont()->setBold(true);
        $sheet->getStyle($headerRow)->getAlignment()->setHorizontal('center');
        $sheet->getStyle($headerRow)->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFF00');

        // Freeze the first row
        $sheet->freezePane('A2');

        // Set the style for leave and shift_off cells
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) {
            for ($col = 'B'; $col <= $highestColumn; $col++) {
                $cell = $sheet->getCell($col . $row);
                if ($cell->getValue() === 'OFF') {
                    $sheet->getStyle($col . $row)->getFill()->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FF0000');
                } elseif ($cell->getValue() === 'Leave') {
                    $sheet->getStyle($col . $row)->getFill()->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFFF00');
                }
            }
        }
    }
}
