<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Eventos UNAH-tec Danlí
    </h2>
</x-slot>

<div class="flex-row justify-center items-center p-5">
    <div class="flex justify-center">
        <div class="w-1/2  bg-white rounded-2xl p-10">
            <h2 class="text-xl font-bold"><strong>Código: </strong>{{ $event->id }}</h2>
            <h1>{{ $event->event_name }}</h1>
            <h1>Fecha: {{ $event->release_date }}</h1>
            <h1>Hora: {{ $event->start_hour }}</h1>

        </div>
    </div>

    <div class="flex justify-end p-2">
        @if ($event->status == 'Abierto')
            <button class="bg-yellow-500 p-2 font-bold rounded text-white" wire:click="$emit('triggerConfirm')">
                Cerrar Evento
                <svg wire:loading.delay class="animate-spin w-6 h-6 mx-auto" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
        @endif

        <script>
            window.onload = function() {
                Livewire.on('triggerConfirm', () => {
                    Swal.fire({
                        title: '¿Está seguro?',
                        text: '¡Los estudiantes que no se hayan registrados quedarán fuera!',
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#FBBF24',
                        cancelButtonColor: '#2563EB',
                        confirmButtonText: 'Cerrar Evento',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        // si se termina el evento
                        if (result.value) {
                            // llamo al metodo para exportarExcel
                            @this.call('closeEvent')
                        }
                    });
                })
            }
        </script>

        {{-- <script>
            window.onload = function() {
                Livewire.on('triggerConfirm', () => {
                
                    if(confirm('¿Esta seguro que desea cerrar el evento?')){
                        @this.call('exportExcel')
                    }
                })
            }
        </script> --}}
    </div>

    <div class="shadow-md rounded overflow-x-auto">
        <table class="min-w-max w-full table-auto bg-white rounded">
            <thead class="text-gray-600 font-bold py-2 uppercase text-center text-sm items-center leading-normal">
                <tr>
                    <td class="py-2">Id</td>
                    <td>Nombre Completo</td>
                    <td>Número de cuenta</td>
                    <td>Correo </td>
                    <td>Carrera</td>
                    <td>Estado</td>

                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($asistances as $a)
                    <tr class="border-b border-gray-200 hover:bg-gray-100 text-md">
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $a->id }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $a->full_name }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $a->account_number }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $a->email }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $a->career }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">
                            @if ($a->status == 'salida')
                                <span class="bg-blue-600 font-bold  text-white rounded-xl p-1">{{ $a->status }}
                                </span>
                            @else
                                <span class="bg-yellow-500 font-bold text-white rounded-xl p-1">{{ $a->status }}
                                </span>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- {{ $asistances->links()}} --}}
</div>
