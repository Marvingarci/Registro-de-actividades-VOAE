<?php

namespace App\Http\Livewire\Asistance;

use App\Models\Asistance;
use App\Models\Event;
use App\Notifications\ConstanciaNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\checkCode;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class CreateAttendance extends Component
{
    use WithFileUploads;

    public $data = [

        'full_name' => '',
        'account_number' => '',
        'email' => '',
        'event_id' => '',
        'career' => '',
    ];

    public $photo;

    public function render()
    {
        return view('livewire.asistance.create-attendance')->layout('layouts.guest');
    }

    public function saveAttendance()
    {

        //Puse aqui las validaciones porque no me dejaba setear la RULE en el metodo de arrriba
        $this->validate([
            'data.full_name' => 'required',
            'data.account_number' => 'required',
            'data.email' => 'required',
            'data.event_id' => ['required', new checkCode()],
            'data.career' => 'required',
            'photo' => 'required',
        ], [
            'data.full_name.required' => 'El nombre es obligatiorio.',
            'data.account_number.required' => 'El número de cuenta es obligatorio.',
            'data.account_number.unique' => 'El número de cuenta ya existe en los registros.',
            'data.email.required' => 'El correo institucional es obligatorio.',
            'data.email.unique' => 'El correo ya existe en los registros.',
            'data.career.required' => 'La carrera es obligatoria.',
            'data.event_id.required' => 'El código del evento es obligatorio.',
            'photo.required' => 'La foto es un comprobante obligatorio.',
        ]);

        $imageUrl = $this->photo->storeAs('public/uploads', "{$this->data['account_number']}.jpg");

        $event = Event::where('id', $this->data['event_id'])->first();

        $attendance = new Asistance();

        try {

            if ($event->status == "Abierto") {
                $attendance->full_name = strtoupper($this->data['full_name']);
                $attendance->account_number = $this->data['account_number'];
                $attendance->email = $this->data['email'];
                $attendance->career = $this->data['career'];
                $attendance->event_id = $this->data['event_id'];
                $attendance->image =  "{$this->data['account_number']}.jpg";
                $attendance->start_asistance =  Carbon::now()->format('H:i');

                $attendance->save();

                // Notification::route('mail', [
                //     $attendance->email => $attendance->full_name
                // ])->notify(new ConstanciaNotification($attendance));

                return redirect()->route('home');
            } else {
                session()->flash('error', 'El evento ya cerró');
            }
        } catch (QueryException $ex) {

            session()->flash('error', 'Ya tienes un registro en este evento');
        }
    }
}
