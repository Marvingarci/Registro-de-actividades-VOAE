<?php

namespace App\Http\Livewire\Events;

use LivewireUI\Modal\ModalComponent;
use App\Models\Event;
use Illuminate\Support\Str;
use App\Http\Livewire\Events\EventIndex;

class CreateEvent extends ModalComponent
{
    public Event $event;
    public EventIndex $EventIndex;
    public $editMode = false;
    public $eventToEdit;

    protected $listeners = ['editEvent' => 'chargeEvent'];

    public function render()
    {
        return view('livewire.events.create-event');
    }

    public function mount($e){
        if($e != 0){
            $this->chargeEvent($e);
        }
    }

    public $data = [
        'id' => '',
        'event_name' => '',
        'description' => '',
        'release_date' => '',
        'start_hour' => '',
        'end_hour' => '',
        'status' => '',
    ];

    public $photo;

    protected $rules = [
        'data.event_name' => 'required',
        'data.description' => 'required',
        'data.release_date' => 'required',
        'data.start_hour' => 'required',
        'data.end_hour' => 'required',
        'data.status' => '',
    ];



    protected $messages = [
        'data.event_name.required' => 'El nombre del evento es obligatiorio.',
        'data.description.required' => 'La descripción es obligatoria.',
        'data.release_date.required' => 'La fecha es obligatoria.',
        'data.start_hour.required' => 'la hora de inicio es obligatoria.',
        'data.end_hour.required' => 'La hora final es obligatorio.',
        'data.status.required' => 'El código del evento es obligatorio.',
    ];

    public function saveEvent()
    {

        $this->validate();
        
        $id = Str::uuid()->toString();

        if($this->editMode == true){
            $this->eventToEdit->event_name = $this->data['event_name'];
            $this->eventToEdit->description = $this->data['description'] ;
            $this->eventToEdit->release_date = $this->data['release_date'] ;
            $this->eventToEdit->end_hour =  $this->data['end_hour'];
            $this->eventToEdit->start_hour = $this->data['start_hour'] ;
            $this->eventToEdit->save();
            session()->flash('message', 'Evento editado con éxito');


        }else{
            Event::create([
                'id' => $id,
                'event_name' => strtoupper($this->data['event_name']),
                'description' => $this->data['description'],
                'release_date' => $this->data['release_date'],
                'start_hour' => $this->data['start_hour'],
                'end_hour' => $this->data['end_hour'],
                'status' => true,
            ]);    
               
            session()->flash('message', 'Evento agregado con éxito');
        }
       

        $this->closeModalWithEvents([
           $this->emit('updateEvents')
        ]); 
    }

    public function close(){
        $this->editMode = true;
        $this->closeModalWithEvents([
           
        ]); 
    }

    public function doNothing()
    {
        
    }

    public function chargeEvent($id)
    {
        $this->editMode = true;
        $this->eventToEdit = Event::where('id', $id)->first();
        $this->data['event_name'] = $this->eventToEdit->event_name;
        $this->data['description'] =$this->eventToEdit->description;
        $this->data['release_date'] = $this->eventToEdit->release_date;
        $this->data['end_hour'] = $this->eventToEdit->end_hour;
        $this->data['start_hour'] = $this->eventToEdit->start_hour;

    }
}
