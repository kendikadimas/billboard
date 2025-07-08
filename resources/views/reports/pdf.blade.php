{{-- resources/views/reports/pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keselamatan Kerja</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Keselamatan Kerja</h1>
    <p>Periode: {{ $startDate }} s/d {{ $endDate }}</p>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Man Power</th>
                <th>Jam Kerja</th>
                <th>Fatality</th>
                <th>Kerusakan Barang</th>
                <th>LTI</th>
                <th>LWD</th>
                <th>MTI</th>
                <th>Pelanggaran APD</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
            <tr>
                <td>{{ $record->record_date->format('d-m-Y') }}</td>
                <td>{{ $record->man_power }}</td>
                <td>{{ $record->total_man_hours }}</td>
                <td>{{ $record->fatality }}</td>
                <td>{{ $record->property_damage }}</td>
                <td>{{ $record->lost_time_injury }}</td>
                <td>{{ $record->lost_working_day }}</td>
                <td>{{ $record->medical_treatment_injury }}</td>
                <td>{{ $record->ppe_violation }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>