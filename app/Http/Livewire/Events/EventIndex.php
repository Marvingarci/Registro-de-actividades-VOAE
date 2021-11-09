<?php

namespace App\Http\Livewire\Events;

use Livewire\Component;
use App\Models\Event;
use Livewire\WithPagination;

class EventIndex extends Component
{
    use WithPagination;

    protected $listeners = ['updateEvents' => 'updateEvents'];

    public function render()
    {
        return view('livewire.events.event-index', [
            'events'=> Event::paginate(5),
        ]);
    }

    public function updateEvents()
    {
        $this->resetPage();  //recargar datos de consultas con paginate  
    }

    public function deleteEvent($id){
        $event = Event::find($id);
        $event->delete();
    }
}
