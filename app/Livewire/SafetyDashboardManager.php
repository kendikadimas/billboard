<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SafetyPerformanceRecord;

class SafetyDashboardManager extends Component
{
    // Properti untuk binding form
    public $recordId;
    public $record_date; // Mengganti year dan month
    public $total_man_hours;
    public $fatality;
    public $property_damage;
    public $latest_accident_date;
    public $total_accident_this_month;
    public $man_power;
    public $lost_time_injury;
    public $lost_working_day;
    public $medical_treatment_injury;
    public $ppe_violation;
    public $start_date;
    public $end_date;   

    public function mount()
    {
        // Default ke tanggal hari ini
        $this->record_date = now()->format('Y-m-d');
        $this->start_date = now()->startOfMonth()->format('Y-m-d');
        $this->end_date = now()->endOfMonth()->format('Y-m-d');
        $this->loadRecord();
    }

    public function loadRecord()
    {
        $record = SafetyPerformanceRecord::where('record_date', $this->record_date)->first();

        if ($record) {
            $this->recordId = $record->id;
            $this->total_man_hours = $record->total_man_hours;
            $this->fatality = $record->fatality;
            $this->property_damage = $record->property_damage;
            $this->latest_accident_date = $record->latest_accident_date ? $record->latest_accident_date->format('Y-m-d') : null;
            $this->total_accident_this_month = $record->total_accident_this_month;
            $this->man_power = $record->man_power;
            $this->lost_time_injury = $record->lost_time_injury;
            $this->lost_working_day = $record->lost_working_day;
            $this->medical_treatment_injury = $record->medical_treatment_injury;
            $this->ppe_violation = $record->ppe_violation;
        } else {
            $this->resetForm();
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'record_date' => 'required|date',
            'total_man_hours' => 'required|integer|min:0',
            'fatality' => 'required|integer|min:0',
            'property_damage' => 'required|integer|min:0',
            'latest_accident_date' => 'nullable|date',
            'total_accident_this_month' => 'required|integer|min:0',
            'man_power' => 'required|integer|min:0',
            'lost_time_injury' => 'required|integer|min:0',
            'lost_working_day' => 'required|integer|min:0',
            'medical_treatment_injury' => 'required|integer|min:0',
            'ppe_violation' => 'required|integer|min:0',
        ]);

        SafetyPerformanceRecord::updateOrCreate(
            ['record_date' => $this->record_date],
            $validatedData
        );

        session()->flash('message', 'Data untuk tanggal ' . $this->record_date . ' berhasil diperbarui.');
    }
    
    private function resetForm()
    {
         $this->recordId = null;
         // Jangan reset tanggal, agar tetap pada tanggal yang dipilih
         // $this->record_date = now()->format('Y-m-d');
         $this->total_man_hours = 0;
         $this->fatality = 0;
         $this->property_damage = 0;
         $this->latest_accident_date = null;
         $this->total_accident_this_month = 0;
         $this->man_power = 0;
         $this->lost_time_injury = 0;
         $this->lost_working_day = 0;
         $this->medical_treatment_injury = 0;
         $this->ppe_violation = 0;
    }

    public function render()
    {
        return view('livewire.safety-dashboard-manager')->layout('layouts.app');
    }
}