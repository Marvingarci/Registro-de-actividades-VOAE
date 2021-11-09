<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Http\Livewire\Users\UserIndex;
use App\Models\User;
use Illuminate\Validation\Rule;

class CreateUser extends ModalComponent
{
    public User $user;
    public UserIndex $UserIndex;
    public $editMode = false;
    public $userToEdit;

    protected $listeners = ['editUser' => 'chargeUser'];

    public function render()
    {
        return view('livewire.users.create-user');
    }

    public function mount($e)
    {
        if ($e != 0) {
            $this->chargeUser($e);
        }
    }

    public $data = [
        'id' => '',
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'is_admin' => 0
    ];

    protected $messages = [

        'data.name.required' => 'El nombre es obligatiorio.',
        'data.email.required' => 'EL correo electrónico es obligatorio.',
        'data.email.email' => 'El correo es inválido.',
        'data.email.unique' => 'El correo ya ha sido registrado.',
        'data.password.required' => 'La contraseña es obligatoria.',
        'data.password.confirmed' => 'La contraseña no coincide',

    ];

    public function saveUser()
    {

        if ($this->editMode == true) {

            $this->validate([
                'data.name' => 'required',
                'data.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->data['id'])],
            ]);

            $this->userToEdit->name = $this->data['name'];
            $this->userToEdit->email = $this->data['email'];
            $this->userToEdit->is_admin = $this->data['is_admin'];

           $this->userToEdit->update(); 

            session()->flash('message', 'Usuario editado con éxito');

        } else {

            $this->validate([
                'data.name' => 'required',
                'data.email' => ['required', 'email', Rule::unique('users', 'email')],
                'data.password' => ['required', 'confirmed'],
                'data.password_confirmation' => 'required '
            ]);

            User::create([
                'name' => strtoupper($this->data['name']),
                'email' => $this->data['email'],
                'password' => bcrypt($this->data['password']),
                'is_admin' => $this->data['is_admin'],
            ]);

            session()->flash('message', 'Usuario agregado con éxito');
        }


        $this->closeModalWithEvents([
            $this->emit('updateUsers')
        ]);
    }

    public function close()
    {
        $this->editMode = true;
        $this->closeModalWithEvents([]);
    }

    public function chargeUser($id)
    {
        $this->editMode = true;

        $this->userToEdit = User::findOrFail($id);

        $this->data['id'] = $this->userToEdit->id;
        $this->data['name'] = $this->userToEdit->name;
        $this->data['email'] = $this->userToEdit->email;
        $this->data['is_admin'] = $this->userToEdit->is_admin;
    }
}
