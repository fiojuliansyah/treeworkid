<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SiteAttendanceExport implements FromCollection, WithHeadings, WithStyles
{
    protected $attendancesByUser;
    protected $dates;
    protected $totalsByUser;
    protected $highlightCellsLeave = [];
    protected $highlightCellsShiftOff = [];
    protected $highlightCellsBeritaAcara = [];
    protected $mergedCells = [];
    protected $totalShiftOffByUser = [];

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
                'totalHK' => '',
                'totalOvertime' => '',
                'totalBA' => '',
                'totalLeave' => '',
            ];

            $totalShiftOff = 0;
            $row = [$user->name];
            $rowIndex = count($data) + 3; // Adjust row index for Excel rows starting from 3

            foreach ($this->dates as $index => $date) {
                $attendance = $userAttendances->get($date->format('Y-m-d'));
                if ($attendance) {
                    if ($attendance->leave_id != null) {
                        $row[] = $attendance->leave->type['name'];
                        $row[] = '';
                        $this->highlightCellsLeave[] = [$rowIndex, count($row) - 2]; // Highlight leave cell
                        $this->mergedCells[] = [$rowIndex, count($row) - 2]; // Merge IN and OUT for leave
                    } elseif ($attendance->type == 'shift_off') {
                        $row[] = 'OFF';
                        $row[] = '';
                        $this->highlightCellsShiftOff[] = [$rowIndex, count($row) - 2]; // Highlight shift_off cell
                        $this->mergedCells[] = [$rowIndex, count($row) - 2]; // Merge IN and OUT for shift_off
                        $totalShiftOff++;
                    } elseif ($attendance->type == 'berita_acara') {
                        $row[] = $attendance->clock_in ? $attendance->clock_in->format('H:i') : '-';
                        $row[] = $attendance->clock_out ? $attendance->clock_out->format('H:i') : '-';
                        $this->highlightCellsBeritaAcara[] = [$rowIndex, count($row) - 2]; // Highlight berita_acara cell
                        $this->mergedCells[] = [$rowIndex, count($row) - 2]; // Merge IN and OUT for berita_acara
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
            $row[] = $totalShiftOff; // Add total shift_off to the row

            $data[] = $row;
            $this->totalShiftOffByUser[$user_id] = $totalShiftOff;
        }

        return collect($data);
    }

    public function headings(): array
    {
        $headings = ['Nama Karyawan'];

        foreach ($this->dates as $date) {
            $headings[] = $date->format('d');
            $headings[] = '';
        }

        $headings = array_merge($headings, [
            'Total HK',
            'Total Lembur',
            'Total BA',
            'Total Cuti',
            'Total OFF' // Add heading for total shift-off
        ]);

        // Additional row for "IN" and "OUT"
        $subHeadings = [''];
        foreach ($this->dates as $date) {
            $subHeadings[] = 'IN';
            $subHeadings[] = 'OUT';
        }

        return [
            $headings,
            $subHeadings
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header row style
        $sheet->getStyle('1:1')->getFont()->setBold(true);
        $sheet->getStyle('1:1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Sub-header row style
        $sheet->getStyle('2:2')->getFont()->setBold(true);
        $sheet->getStyle('2:2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Merge cells for IN and OUT headers
        $startColumnIndex = 2;
        foreach ($this->dates as $index => $date) {
            $endColumnIndex = $startColumnIndex + 1;
            $sheet->mergeCells($this->getColumnLetter($startColumnIndex) . '1:' . $this->getColumnLetter($endColumnIndex) . '1');
            $startColumnIndex = $endColumnIndex + 1;
        }

        // Apply cell styles
        foreach ($this->highlightCellsLeave as [$rowIndex, $columnIndex]) {
            $startCell = $this->getColumnLetter($columnIndex + 1) . $rowIndex;
            $endCell = $this->getColumnLetter($columnIndex + 2) . $rowIndex;
            $sheet->mergeCells("$startCell:$endCell");
            $sheet->getStyle($startCell)->getFill()->setFillType(Fill::FILL_SOLID)
                                                  ->getStartColor()->setARGB('FFFF00'); // Yellow for leave
            $sheet->getStyle($startCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center alignment
        }
    
        foreach ($this->highlightCellsShiftOff as [$rowIndex, $columnIndex]) {
            $startCell = $this->getColumnLetter($columnIndex + 1) . $rowIndex;
            $endCell = $this->getColumnLetter($columnIndex + 2) . $rowIndex;
            $sheet->mergeCells("$startCell:$endCell");
            $sheet->getStyle($startCell)->getFill()->setFillType(Fill::FILL_SOLID)
                                                  ->getStartColor()->setARGB('FF6347'); // Orange for shift_off
            $sheet->getStyle($startCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center alignment
        }

        foreach ($this->highlightCellsBeritaAcara as [$rowIndex, $columnIndex]) {
            $cell = $this->getColumnLetter($columnIndex + 1) . $rowIndex;
            $sheet->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID)
                                              ->getStartColor()->setARGB('1CADEA'); // Color for berita_acara (Tomato)
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center alignment
        }

        foreach ($this->highlightCellsBeritaAcara as [$rowIndex, $columnIndex]) {
            $cell = $this->getColumnLetter($columnIndex + 2) . $rowIndex;
            $sheet->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID)
                                              ->getStartColor()->setARGB('1CADEA'); // Color for berita_acara (Tomato)
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center alignment
        }


        // Freeze pane
        $sheet->freezePane('A3');
    }

    private function getColumnLetter($index)
    {
        $letters = [];
        while ($index > 0) {
            $letters[] = chr(($index - 1) % 26 + 65);
            $index = intval(($index - 1) / 26);
        }
        return implode('', array_reverse($letters));
    }
}
