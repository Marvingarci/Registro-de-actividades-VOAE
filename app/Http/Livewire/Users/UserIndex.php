<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    protected $listeners = ['updateUsers' => 'updateUsers'];

    public function render()
    {
        return view('livewire.users.user-index', [
            'users'=> User::paginate(5),
        ]);
    }

    public function updateUsers()
    {
        $this->resetPage();  //recargar datos de consultas con paginate  
    }
    public function deleteUser($id)
    {
        $event = User::findOrFail($id);
        $event->delete();
    }

}
