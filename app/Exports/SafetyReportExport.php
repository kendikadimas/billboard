<?php

namespace App\Exports;

use App\Models\SafetyPerformanceRecord;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SafetyReportExport implements FromQuery, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return SafetyPerformanceRecord::query()
            ->whereBetween('record_date', [$this->startDate, $this->endDate])
            ->orderBy('record_date', 'asc');
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Man Power',
            'Total Man Hours',
            'Fatality',
            'Property Damage',
            'Lost Time Injury',
            'Lost Working Day',
            'Medical Treatment Injury',
            'PPE Violation',
            'Total Accident This Month',
            'Latest Accident Date',
        ];
    }

    public function map($record): array
    {
        return [
            $record->record_date->format('d-m-Y'),
            $record->man_power,
            $record->total_man_hours,
            $record->fatality,
            $record->property_damage,
            $record->lost_time_injury,
            $record->lost_working_day,
            $record->medical_treatment_injury,
            $record->ppe_violation,
            $record->total_accident_this_month,
            $record->latest_accident_date ? $record->latest_accident_date->format('d-m-Y') : 'N/A',
        ];
    }
}