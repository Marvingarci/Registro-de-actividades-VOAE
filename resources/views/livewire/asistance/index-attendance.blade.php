<div class="flex flex-col justify-center p-5">
    <div class="flex justify-end p-2">
        <button class="bg-green-500 p-2 rounded text-white"
            wire:click="exportExcell">
            Cerrar Actividad
        </button>
    </div>
    <table class="min-w-max w-full table-auto bg-white rounded">
        <thead class="text-gray-600 font-bold py-2 uppercase text-center text-sm items-center leading-normal">
            <tr>
                <td class="py-4">Nombre</td>
                <td>Número de cuenta</td>
                <td>Correo</td>
                <td>Carrera</td>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach ($asistances as $attendance)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-6 py-2 text-center whitespace-nowrap">{{ $attendance->full_name }} </td>
                    <td class="px-6 py-2 text-center whitespace-nowrap">{{ $attendance->account_number }} </td>
                    <td class="px-6 py-2 text-center whitespace-nowrap">{{ $attendance->email }} </td>
                    <td class="px-6 py-2 text-center whitespace-nowrap">{{ $attendance->career }} </td>
                    {{-- <td class="px-6 py-4 text-center whitespace-nowrap">
                        <x-table-button href="{{ url('/doctores/editar/' . $d->id) }}">
                            Editar
                        </x-table-button>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{ $asistances->links() }}
</div
