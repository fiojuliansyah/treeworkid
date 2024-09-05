<?php

namespace App\Exports;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiteAttendanceExport implements FromCollection, WithHeadings, WithStyles
{
    protected $attendancesByUser;
    protected $dates;
    protected $totalsByUser;
    protected $highlightCellsLeave = [];
    protected $highlightCellsShiftOff = [];
    protected $highlightCellsBeritaAcara = [];
    protected $highlightCellsOvertime = [];
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
                'totalOvertimeIn' => '',
                'totalOvertimeOut' => '',
                'totalBA' => '',
                'totalLeave' => '',
            ];
    
            $totalShiftOff = 0;
            $row = [$user->name];
            $rowIndex = count($data) + 3;
    
            foreach ($this->dates as $index => $date) {
                $attendance = $userAttendances->get($date->format('Y-m-d'));
                if ($attendance) {
                    if ($attendance->leave_id != null) {
                        $row[] = $attendance->leave->type['name'];
                        $row[] = '';
                        $row[] = '';
                        $this->highlightCellsLeave[] = [$rowIndex, count($row) - 3];
                        $this->mergedCells[] = [$rowIndex, count($row) - 3];
                    } elseif ($attendance->type == 'shift_off') {
                        $row[] = 'OFF';
                        $row[] = '';
                        $row[] = '';
                        $this->highlightCellsShiftOff[] = [$rowIndex, count($row) - 3];
                        $this->mergedCells[] = [$rowIndex, count($row) - 3];
                        $totalShiftOff++;
                    } elseif ($attendance->type == 'berita_acara') {
                        $row[] = $attendance->clock_in ? $attendance->clock_in->format('H:i') : '-';
                        $row[] = $attendance->clock_out ? $attendance->clock_out->format('H:i') : '-';
                        $this->highlightCellsBeritaAcara[] = [$rowIndex, count($row) - 2];
    
                        $totalOvertimeMinutes = 0;
                        foreach ($attendance->overtimes as $overtime) {
                            try {
                                $overtimeStart = Carbon::parse($overtime->clock_in);
                                $overtimeEnd = Carbon::parse($overtime->clock_out);
    
                                if ($overtimeEnd && $overtimeStart) {
                                    $overtimeMinutes = $overtimeStart->diffInMinutes($overtimeEnd);
                                    $totalOvertimeMinutes += $overtimeMinutes;
                                }
                            } catch (\Exception $e) {
                                // Handle exception if needed
                            }
                        }
                        $overtimeHours = intdiv($totalOvertimeMinutes, 60);
                        $remainingMinutes = $totalOvertimeMinutes % 60;
                        $overtimeFormatted = $totalOvertimeMinutes > 0 ? sprintf('%02d:%02d', $overtimeHours, $remainingMinutes) : '-';
                        $row[] = $overtimeFormatted;
                        $this->highlightCellsOvertime[] = [$rowIndex, count($row) - 1];
                    } else {
                        $row[] = $attendance->clock_in ? $attendance->clock_in->format('H:i') : '-';
                        $row[] = $attendance->clock_out ? $attendance->clock_out->format('H:i') : '-';
    
                        $totalOvertimeMinutes = 0;
                        foreach ($attendance->overtimes as $overtime) {
                            try {
                                $overtimeStart = Carbon::parse($overtime->clock_in);
                                $overtimeEnd = Carbon::parse($overtime->clock_out);
    
                                if ($overtimeEnd && $overtimeStart) {
                                    $overtimeMinutes = $overtimeStart->diffInMinutes($overtimeEnd);
                                    $totalOvertimeMinutes += $overtimeMinutes;
                                }
                            } catch (\Exception $e) {
                                // Handle exception if needed
                            }
                        }
                        $overtimeHours = intdiv($totalOvertimeMinutes, 60);
                        $remainingMinutes = $totalOvertimeMinutes % 60;
                        $overtimeFormatted = $totalOvertimeMinutes > 0 ? sprintf('%02d:%02d', $overtimeHours, $remainingMinutes) : '-';
                        $row[] = $overtimeFormatted;
                        $this->highlightCellsOvertime[] = [$rowIndex, count($row) - 1];
                    }
                } else {
                    $row[] = '-';
                    $row[] = '-';
                    $row[] = '-'; 
                }
            }
    
            $row[] = $totals['totalHK'];
            $row[] = $totals['totalOvertime'];
            $row[] = $totals['totalBA'];
            $row[] = $totals['totalLeave'];
            $row[] = $totalShiftOff; 
    
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
            $headings[] = '';
        }

        $headings = array_merge($headings, [
            'Total HK',
            'Total Lembur',
            'Total BA',
            'Total Cuti',
            'Total OFF' 
        ]);

        $subHeadings = [''];
        foreach ($this->dates as $date) {
            $subHeadings[] = 'IN';
            $subHeadings[] = 'OUT';
            $subHeadings[] = 'LEMBUR';
        }

        return [
            $headings,
            $subHeadings
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1:1')->getFont()->setBold(true);
        $sheet->getStyle('1:1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    
        $sheet->getStyle('2:2')->getFont()->setBold(true);
        $sheet->getStyle('2:2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    
        $startColumnIndex = 2;
        foreach ($this->dates as $index => $date) {
            $endColumnIndex = $startColumnIndex + 2;
            $sheet->mergeCells($this->getColumnLetter($startColumnIndex) . '1:' . $this->getColumnLetter($endColumnIndex) . '1');
            $startColumnIndex = $endColumnIndex + 1;
        }
    
        foreach ($this->highlightCellsLeave as [$rowIndex, $columnIndex]) {
            $startCell = $this->getColumnLetter($columnIndex + 1) . $rowIndex;
            $endCell = $this->getColumnLetter($columnIndex + 3) . $rowIndex;
            $sheet->mergeCells("$startCell:$endCell");
            $sheet->getStyle($startCell)->getFill()->setFillType(Fill::FILL_SOLID)
                                                  ->getStartColor()->setARGB('FFFF00');
            $sheet->getStyle($startCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
    
        foreach ($this->highlightCellsShiftOff as [$rowIndex, $columnIndex]) {
            $startCell = $this->getColumnLetter($columnIndex + 1) . $rowIndex;
            $endCell = $this->getColumnLetter($columnIndex + 3) . $rowIndex;
            $sheet->mergeCells("$startCell:$endCell");
            $sheet->getStyle($startCell)->getFill()->setFillType(Fill::FILL_SOLID)
                                                  ->getStartColor()->setARGB('FF6347');
            $sheet->getStyle($startCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
    
        foreach ($this->highlightCellsBeritaAcara as [$rowIndex, $columnIndex]) {
            $startCell = $this->getColumnLetter($columnIndex + 1) . $rowIndex;
            $endCell = $this->getColumnLetter($columnIndex + 2) . $rowIndex;
            $sheet->getStyle($startCell)->getFill()->setFillType(Fill::FILL_SOLID)
                                                  ->getStartColor()->setARGB('1CADEA');
            $sheet->getStyle($endCell)->getFill()->setFillType(Fill::FILL_SOLID)
                                                  ->getStartColor()->setARGB('1CADEA');
            $sheet->getStyle($startCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
    
        foreach ($this->highlightCellsOvertime as [$rowIndex, $columnIndex]) {
            $cellValue = $sheet->getCell($this->getColumnLetter($columnIndex + 1) . $rowIndex)->getValue();
            if ($cellValue !== '-') {
                $startCell = $this->getColumnLetter($columnIndex + 1) . $rowIndex;
                $endCell = $this->getColumnLetter($columnIndex + 2) . $rowIndex;
                $sheet->getStyle($startCell)->getFill()->setFillType(Fill::FILL_SOLID)
                                                      ->getStartColor()->setARGB('6EE7B7');
                $sheet->getStyle($startCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        }
    }
    

    private function getColumnLetter($columnNumber)
    {
        $letters = '';
        while ($columnNumber > 0) {
            $columnNumber--;
            $letters = chr($columnNumber % 26 + 65) . $letters;
            $columnNumber = (int)($columnNumber / 26);
        }
        return $letters;
    }
}
