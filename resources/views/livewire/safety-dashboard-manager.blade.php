<div class="h-screen bg-gray-100 flex flex-col">
    <div class="bg-white shadow-md p-4 border-b border-gray-200">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800 mb-2 sm:mb-0">Admin Panel - Safety Performance</h1>
            <div id="running-clock" class="text-sm font-medium text-gray-600 bg-gray-200 px-3 py-1 rounded-full">Memuat jam...</div>
        </div>
    </div>

    <div class="flex-grow overflow-y-auto">
        <div class="max-w-7xl mx-auto p-4 sm:p-6">

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-6">
                    <label for="record_date" class="block text-gray-700 text-sm font-bold mb-2">Pilih Tanggal Data</label>
                    <input type="date" wire:model="record_date" wire:change="loadRecord" id="record_date" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                @if (session()->has('message'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
                        <p class="font-bold">Sukses</p>
                        <p>{{ session('message') }}</p>
                    </div>
                @endif


                <div class="my-6 p-4 bg-slate-50 rounded-lg border border-slate-200">
                    <h3 class="font-bold text-lg text-slate-700 mb-2">Export Laporan</h3>
                    <p class="text-sm text-slate-500 mb-4">Pilih rentang tanggal untuk mengekspor data keselamatan kerja.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                        <div class="md:col-span-1">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" wire:model="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="md:col-span-1">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                            <input type="date" wire:model="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        {{-- Tombol akan menggunakan GET request, bukan wire:click --}}
                        <a href="{{ route('report.export.excel', ['start_date' => $start_date, 'end_date' => $end_date]) }}" target="_blank" class="md:col-span-1 text-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Export Excel
                        </a>
                        <a href="{{ route('report.export.pdf', ['start_date' => $start_date, 'end_date' => $end_date]) }}" target="_blank" class="md:col-span-1 text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Export PDF
                        </a>
                    </div>
                </div>

                <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
                    <div class="mb-2">
                        <label for="man_power" class="block text-gray-700 text-sm font-bold mb-2">Man Power</label>
                        <input type="number" wire:model.defer="man_power" id="man_power" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label for="total_man_hours" class="block text-gray-700 text-sm font-bold mb-2">Total Man Hours</label>
                        <input type="number" wire:model.defer="total_man_hours" id="total_man_hours" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label for="latest_accident_date" class="block text-gray-700 text-sm font-bold mb-2">The Latest Accident</label>
                        <input type="date" wire:model.defer="latest_accident_date" id="latest_accident_date" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label for="fatality" class="block text-gray-700 text-sm font-bold mb-2">Fatality</label>
                        <input type="number" wire:model.defer="fatality" id="fatality" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label for="lost_time_injury" class="block text-gray-700 text-sm font-bold mb-2">Lost Time Injury</label>
                        <input type="number" wire:model.defer="lost_time_injury" id="lost_time_injury" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label for="lost_working_day" class="block text-gray-700 text-sm font-bold mb-2">Lost Working Day</label>
                        <input type="number" wire:model.defer="lost_working_day" id="lost_working_day" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label for="property_damage" class="block text-gray-700 text-sm font-bold mb-2">Property Damage</label>
                        <input type="number" wire:model.defer="property_damage" id="property_damage" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label for="medical_treatment_injury" class="block text-gray-700 text-sm font-bold mb-2">Medical Treatment Injury</label>
                        <input type="number" wire:model.defer="medical_treatment_injury" id="medical_treatment_injury" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label for="ppe_violation" class="block text-gray-700 text-sm font-bold mb-2">PPE Violation</label>
                        <input type="number" wire:model.defer="ppe_violation" id="ppe_violation" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-2 md:col-span-2 lg:col-span-3">
                        <label for="total_accident_this_month" class="block text-gray-700 text-sm font-bold mb-2">Total Accident up to this Month</label>
                        <input type="number" wire:model.defer="total_accident_this_month" id="total_accident_this_month" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="md:col-span-2 lg:col-span-3 mt-4">
                        <button type="submit" wire:click="save" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-transform transform hover:scale-105">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const clockElement = document.getElementById('running-clock');
            if (clockElement) {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                const dateString = now.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                clockElement.innerText = `${dateString}, ${timeString}`;
            }
        }
        setInterval(updateClock, 1000);
        document.addEventListener('DOMContentLoaded', updateClock);
    </script>
</div>