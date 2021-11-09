<div class="flex flex-col justify-center h-screen w-screen items-center">
    @if (session()->has('error'))
        <div class="text-center font-bold text-red-500 bg-red-200 rounded-lg m-5 p-2">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-center text-2xl font-bold text-gray-800">
        Registrar Salida
    </h1>

    <form class="shadow-2xl rounded-xl p-10 m-2 sm:m-0" wire:submit.prevent="closeAsistance">
        <x-input-text name="full_name" wire:model.defer="event_id" :label="'Ingrese el código del evento'">
            @error('event_id')
                <span class="text-red-500">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </x-input-text>
        <x-input-text name="full_name" wire:model.defer="account_number" :label="'Ingrese su número de cuenta'">
            @error('account_number')
                <span class="text-red-500">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </x-input-text>
        <div class="flex justify-center gap-2 p-5">
            <a class="bg-blue-600 p-2 text-white font-bold text-center rounded-lg" href="{{ route('home') }}">Cancelar
            </a>
            <button class="bg-yellow-500 p-2 text-white font-bold text-center rounded-lg" type="submit">
                Enviar
                <svg wire:loading.delay class="animate-spin w-6 h-6 mx-auto" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
        </div>

    </form>

</div>
