<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Eventos UNAH-tec Danlí
    </h2>
</x-slot>

<div class="card px-5 pt-5">

    <div class="full-w text-center pt-10 flex justify-center items-center ">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
</svg>
        <label class="font-bold uppercase text-center text-lg text-gray-600">Usuarios</label>
    </div>

    <div class="flex justify-end p-2">
        <button class="bg-yellow-300 p-2 font-bold rounded text-white"
            onclick="Livewire.emit('openModal', 'users.create-user', {{ json_encode(["e" => '0']) }})">
            Crear
        </button>
    </div>


    <div class="shadow-md rounded overflow-x-auto ">

        <table class="min-w-max w-full table-auto bg-white rounded">
            <thead class=" text-gray-600 font-bold py-2 uppercase text-center text-sm items-center leading-normal">
                <tr>
                    <td >No.</td>
                    <td class="py-2">Nombre</td>
                    <td>Correo Electrónico</td>
                    <td>Creacion</td>
                    <td></td>

                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($users as $user)    
                    <tr class="border-b border-gray-200 hover:bg-gray-100 text-md">
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $user->id }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $user->name }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $user->email }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $user->created_at }} </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap flex space-x-5">
                            @if( $user->id == Auth::user()->id)
                            <a href="user/profile">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
</a>
                            @else
                            <button wire:click="$emit('openModal', 'users.create-user', {{ json_encode(["e" => $user->id]) }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>

                            @endif
        
                            <button  wire:click="$emit('triggerConfirm', '{{$user->id}}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
</svg>
                            </button>
                        </td>
                    </tr>
                @endforeach

                <script>
                    window.onload = function() {
                        Livewire.on('triggerConfirm', (event_id) => {
                            Swal.fire({
                                title: '¿Está seguro?',
                                text: '¡Se borrará este usuario!',
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: '#FBBF24',
                                cancelButtonColor: '#2563EB',
                                confirmButtonText: 'Confirmar',
                                cancelButtonText: 'Cancelar',
                            }).then((result) => {
                                // si se termina el evento
                                if (result.value) {
                                    // llamo al metodo para exportarExcel
                                    @this.call('deleteUser', event_id)
                                }
                            });
                        })
                    }
                </script>
            </tbody>



        </table>

        {{ $users->links() }}


    </div>

    

</div>
