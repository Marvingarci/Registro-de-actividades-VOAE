<div class="p-5">
    @if ($editMode == false)
        <h1 class="font-bold text-xl text-center">Crear Evento</h1>
    @endif
    @if ($editMode == true)
        <h1 class="font-bold text-xl text-center">Editar Evento</h1>
    @endif

    <form wire:submit.prevent="saveEvent">

        <div class="grid sm:grid-cols-2 gap-4">

            <x-input-text wire:keydown.enter="doNothing()" name="event_name" wire:model.defer="data.event_name"
                :label="'Ingrese el título del evento'">
                @error('data.event_name')
                    <span class="text-red-500">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </x-input-text>
            <x-input-text wire:keydown.enter="doNothing()" name="description" wire:model.defer="data.description"
                :label="'Ingrese una descripcion'">
                @error('data.description')
                    <span class="text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </x-input-text>

            <x-input-text type="date" name="release_date" wire:model.defer="data.release_date"
                :label="'Ingrese la fecha del evento '">
                @error('data.release_date')
                    <span class="text-red-500">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </x-input-text>

            <x-input-text type="time" name="start_hour" wire:model.defer="data.start_hour"
                :label="'Selecciones la hora de inicio'">
                @error('data.start_hour')
                    <span class="text-red-500">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </x-input-text>


            <x-input-text type="time" name="end_hour" wire:model.defer="data.end_hour"
                :label="'Seleccione la hora de finalizacion'">
                @error('data.end_hour')
                    <span class="text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </x-input-text>

        </div>

        <div class="flex justify-center gap-2 mt-2">
            <button type="button" class="bg-blue-600 p-2 text-white font-bold text-center rounded-lg"
                wire:click='close()'>
                Cancelar
            </button>
            <button class="bg-yellow-500 p-2 text-white font-bold text-center rounded-lg" type="submit">
                Registrar
                <svg wire:loading.delay class="animate-spin w-6 h-6 mx-auto" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>

        </div>

    </form>

</div>
