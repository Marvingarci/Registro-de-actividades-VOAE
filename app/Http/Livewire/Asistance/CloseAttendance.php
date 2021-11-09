<?php

namespace App\Http\Livewire\Asistance;

use App\Models\Asistance;
use Carbon\Carbon;
use Livewire\Component;

class CloseAttendance extends Component
{
    public function render()
    {
        return view('livewire.asistance.close-attendance')->layout('layouts.guest');
    }

    public $account_number;
    public $event_id;

    protected $rules = [
        'account_number' => 'required|exists:asistances',
        'event_id' => 'required|exists:asistances',
    ];

    protected $messages = [
        'account_number.required' => 'El número de cuenta es obligatorio.',
        'account_number.exists' => 'El número de cuenta no existe.',
        'event_id.required' => 'El código del evento es obligatorio.',
        'event_id.exists' => 'El código del evento no existe.',
    ];

    public function closeAsistance()
    {

        $this->validate();

        $attendance = Asistance::where('account_number', $this->account_number)
            ->where('event_id', $this->event_id)
            ->first();

        if ($attendance->status == "entrada") {
            $attendance->end_asistance = Carbon::now()->format('H:i');
            $attendance->status = "salida";

            $attendance->save();

            return redirect()->route('home');
        }
        if ($attendance->status == "indefinido") {
            session()->flash('error', 'El evento ya fue cerrado');
        } else {
            session()->flash('error', 'Este número de cuenta ya marcó su salida');
        }
    }
}
