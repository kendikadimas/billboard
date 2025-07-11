<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety Performance Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body { 
            background-color: #f1f5f9; /* slate-100 */
            color: #334155; /* slate-700 */
            font-family: 'Poppins', sans-serif; 
        }
        .digital-number {
            background-color: #e2e8f0; /* slate-200 */
            color: #1e293b; /* slate-800 */
            font-weight: 700;
            padding: 0.1rem 0.4rem;
            border: 1px solid #cbd5e1; /* slate-300 */
            border-radius: 0.375rem;
            text-align: center;
            font-size: 1.25rem;
        }
        @media (min-width: 1024px) { /* lg breakpoint for laptops */
            .digital-number {
                font-size: 2rem;
                padding: 0.25rem 0.75rem;
            }
        }
    </style>
</head>
<body class="min-h-screen w-screen bg-slate-100 flex flex-col">

    <header class="bg-white py-3 px-4 sm:px-6 flex flex-col sm:flex-row justify-between items-center text-center sm:text-left border-b border-slate-200 shadow-sm flex-shrink-0">
        <div>
            <h1 class="text-lg lg:text-2xl font-bold text-slate-800">Safety Performance Board</h1>
            <h2 class="text-sm lg:text-lg text-slate-500">PT Sinar Tambang Arthalestari</h2>
        </div>
        <div id="live-clock" class="bg-slate-100 text-slate-700 p-2 lg:p-3 rounded-lg mt-3 sm:mt-0 text-center">
            <p class="text-xs lg:text-lg font-semibold whitespace-nowrap">Memuat jam...</p>
        </div>
    </header>

    <main class="flex-grow p-2 md:p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-full">
            
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-3 h-full flex flex-col border border-slate-200">
                    <h2 class="text-base md:text-lg font-semibold text-slate-700 mb-2">SAFETY STATUS</h2>
                    
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 mb-2">
                        <div class="bg-slate-100 p-2 rounded-lg text-center flex flex-col justify-center">
                            <span class="font-semibold text-slate-500 text-xs block">TAHUN</span>
                            <p class="text-slate-800 text-xl lg:text-3xl font-bold">{{ $record->record_date->format('Y') }}</p>
                        </div>
                        <div class="bg-slate-100 p-2 rounded-lg text-center flex flex-col justify-center">
                            <span class="font-semibold text-slate-500 text-xs block">BULAN</span>
                            <p class="text-slate-800 text-xl lg:text-3xl font-bold uppercase">{{ $record->record_date->isoFormat('MMM') }}</p>
                        </div>
                        <div class="col-span-2 bg-slate-100 p-2 rounded-lg flex flex-col items-center justify-center">
                            <span class="text-slate-600 font-semibold text-xs sm:text-sm mb-1">JUMLAH JAM KERJA</span>
                            <div class="flex gap-1 sm:gap-2">
                                @foreach(str_split(str_pad($record->total_man_hours, 7, '0', STR_PAD_LEFT)) as $digit)
                                    <div class="digital-number">{{ $digit }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <div class="bg-white border border-slate-200 rounded-lg p-3 text-center flex flex-col justify-center">
                            <span class="text-slate-500 text-xs lg:text-sm block">MENINGGAL / FATALITY</span>
                            <p class="text-blue-600 text-2xl lg:text-4xl font-bold">{{ str_pad($record->fatality, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-lg p-3 text-center flex flex-col justify-center">
                            <span class="text-slate-500 text-xs lg:text-sm block">KERUSAKAN BARANG</span>
                            <p class="text-blue-600 text-2xl lg:text-4xl font-bold">{{ str_pad($record->property_damage, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-lg p-3 text-center flex flex-col justify-center">
                            <span class="text-slate-500 text-xs lg:text-sm block">KECELAKAAN TERAKHIR</span>
                            <p class="text-blue-600 text-lg lg:text-2xl font-bold">{{ $record->latest_accident_date ? $record->latest_accident_date->format('d M Y') : 'N/A' }}</p>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-lg p-3 text-center flex flex-col justify-center">
                            <span class="text-slate-500 text-xs lg:text-sm block">KECELAKAAN BULAN INI</span>
                            <p class="text-blue-600 text-2xl lg:text-4xl font-bold">{{ str_pad($record->total_accident_this_month, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col border border-slate-200 mt-2 md:mt-0">
                <h3 class="text-lg font-semibold text-center mb-2 text-slate-800">Pos Kesehatan STAR</h3>
                <div class="flex-shrink-0">
                    <img src="{{ asset('images/medical.jpg') }}" alt="Pemeriksaan Kesehatan" class="w-full h-auto max-h-40 rounded-md object-cover">
                </div>
                <ul class="mt-3 list-disc list-inside space-y-1 text-sm lg:text-base font-medium text-slate-600">
                    <li>Pemeriksaan Kesehatan</li>
                    <li>Screening Kesehatan</li>
                    <li>Cek Laboratorium dasar</li>
                    <li>dan lain lain</li>
                </ul>
            </div>
        </div>
    </main>

    <div class="bg-slate-800 text-white text-center text-sm md:text-lg font-bold py-2 px-2 flex-shrink-0">
        UTAMAKAN KESELAMATAN DAN KESEHATAN KERJA
    </div>

    <footer class="bg-white p-2 md:p-4 border-t border-slate-200 flex-shrink-0">
        <div class="grid grid-cols-5 gap-2">
            @php
                $stats = [
                    'Man Power' => $record->man_power,
                    'Lost Time Injury' => $record->lost_time_injury,
                    'Lost Working Day' => $record->lost_working_day,
                    'Medical Treatment' => $record->medical_treatment_injury,
                    'PPE Violation' => $record->ppe_violation
                ];
            @endphp
            @foreach($stats as $label => $value)
            <div class="bg-slate-100 rounded-lg p-2 text-center flex flex-col justify-center">
                <span class="text-slate-500 font-semibold h-10 lg:h-12 leading-tight text-xs">{!! $label !!}</span>
                <p class="text-blue-600 text-xl lg:text-3xl font-bold">{{ $value }}</p>
            </div>
            @endforeach
        </div>
    </footer>

    <script>
        function updateClock() {
            const clockElement = document.getElementById('live-clock');
            if (clockElement) {
                const now = new Date();
                const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
                
                const dateString = now.toLocaleDateString('id-ID', dateOptions);
                const timeString = now.toLocaleTimeString('id-ID', timeOptions).replace(/\./g, ':');

                clockElement.querySelector('p').innerHTML = `${dateString} &nbsp;|&nbsp; ${timeString}`;
            }
        }
        document.addEventListener('DOMContentLoaded', updateClock);
        setInterval(updateClock, 1000);
    </script>

</body>
</html>