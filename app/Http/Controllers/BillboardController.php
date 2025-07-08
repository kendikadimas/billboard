<?php

namespace App\Http\Controllers;

use App\Models\SafetyPerformanceRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillboardController extends Controller
{
    public function show()
    {
        // PERUBAHAN: Mengambil data berdasarkan tanggal record terbaru, bukan tahun/bulan
        $record = SafetyPerformanceRecord::orderBy('record_date', 'desc')->first();

        // Jika tidak ada data sama sekali, buat data dummy agar tidak error
        if (!$record) {
            $record = new SafetyPerformanceRecord([
                // Menggunakan record_date untuk dummy data
                'record_date' => now(),
            ]);
        }

        // Atur locale Carbon ke Indonesia
        Carbon::setLocale('id');

        $data = [
            'record' => $record,
            // Menggunakan record_date untuk menampilkan tanggal di billboard
            'current_date' => $record->record_date->isoFormat('dddd, DD MMMM YYYY'),
        ];

        return view('billboard', $data);
    }
}