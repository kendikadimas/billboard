<?php

namespace App\Http\Controllers;

use App\Exports\SafetyReportExport;
use App\Models\SafetyPerformanceRecord;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf; // Alias untuk PDF
use Carbon\Carbon;

class ReportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $fileName = 'Laporan_Keselamatan_' . $request->start_date . '_sd_' . $request->end_date . '.xlsx';

        return Excel::download(new SafetyReportExport($request->start_date, $request->end_date), $fileName);
    }

    public function exportPdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $records = SafetyPerformanceRecord::whereBetween('record_date', [$request->start_date, $request->end_date])
            ->orderBy('record_date', 'asc')
            ->get();
        
        $data = [
            'records' => $records,
            'startDate' => Carbon::parse($request->start_date)->format('d F Y'),
            'endDate' => Carbon::parse($request->end_date)->format('d F Y'),
        ];

        $pdf = Pdf::loadView('reports.pdf', $data);
        $fileName = 'Laporan_Keselamatan_' . $request->start_date . '_sd_' . $request->end_date . '.pdf';
        
        return $pdf->download($fileName);
    }
}