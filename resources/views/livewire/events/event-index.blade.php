<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Eventos UNAH-tec Danlí
    </h2>
</x-slot>

<div class="card px-5 pt-5">

    <div class="full-w text-center pt-10 flex justify-center items-center ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
        </svg>
        <label class="font-bold uppercase text-center text-lg text-gray-600">Eventos</label>
    </div>

    <div class="flex justify-end p-2">
        <button class="bg-yellow-500 p-2 font-bold rounded text-white"
            onclick="Livewire.emit('openModal', 'events.create-event', {{ json_encode(['e' => '0']) }})">
            Crear
        </button>
    </div>


    <div class="shadow-md rounded overflow-x-auto ">

        <table class="min-w-max w-full table-auto bg-white rounded">
            <thead class=" text-gray-600 font-bold py-2 uppercase text-center text-sm items-center leading-normal">
                <tr>
                    <td class="py-2">Nombre</td>
                    <td>descripción</td>
                    <td>Fecha</td>
                    <td>Hora Inicio</td>
                    <td>Hora Final</td>
                    <td>Estado</td>
                    <td></td>

                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($events as $event)
                    <tr class="border-b border-gray-200 hover:bg-gray-100 text-md">
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $event->event_name }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $event->description }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $event->release_date }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $event->start_hour }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">{{ $event->end_hour }} </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">
                            @if ($event->status == 'Cerrado')
                                <span class="bg-blue-600 font-bold  text-white rounded-xl p-1">{{ $event->status }}
                                </span>
                            @else
                                <span class="bg-yellow-500 font-bold text-white rounded-xl p-1">{{ $event->status }}
                                </span>
                            @endif
                        </td>
                        <td class="py-4 text-center whitespace-nowrap flex space-x-5">
                            <a href="{{ url('/ver_evento/' . $event->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </a>
                            <button
                                wire:click="$emit('openModal', 'events.create-event', {{ json_encode(['e' => $event->id]) }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button wire:click="$emit('triggerConfirm', '{{ $event->id }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                                text: '¡Se borrarán todos los registros relacionados a este evento!',
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
                                    @this.call('deleteEvent', event_id)
                                }
                            });
                        })
                    }
                </script>
            </tbody>



        </table>

        {{ $events->links() }}


    </div>

</div>
