<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class SafetyDashboard extends Component
{
    public $currentDate;
    public $currentYear;
    public $currentMonth;
    public $totalManHours = 371840;
    public $fatalities = 0;
    public $propertyDamage = 2;
    public $latestAccidentDate = '06 OKT 23';
    public $monthlyAccidents = 0;
    public $manPower = 464;
    public $lostTimeInjury = 0;
    public $lostWorkingDay = 0;
    public $medicalTreatmentInjury = 0;
    public $ppeViolation = 0;

    public function mount()
    {
        $this->currentDate = Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY');
        $this->currentYear = Carbon::now()->year;
        $this->currentMonth = Carbon::now()->locale('id')->isoFormat('MMMM');
    }

    public function refreshData()
    {
        // Simulate real-time data updates
        $this->totalManHours += rand(1, 10);
        $this->dispatch('dataRefreshed');
    }

    public function render()
    {
        return view('livewire.safety-dashboard');
    }
}