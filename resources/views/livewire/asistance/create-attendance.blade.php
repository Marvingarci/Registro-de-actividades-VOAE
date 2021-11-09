<div>
    <div class="flex flex-col justify-center h-full sm:h-screen items-center">

        <h1 class="text-center text-2xl font-bold text-gray-800">
            Registrar Entrada
        </h1>

        @if (session()->has('error'))
            <div class="text-center font-bold text-red-500 bg-red-200 rounded-lg m-5 p-2">
                {{ session('error') }}
            </div>
        @endif

        <form class="shadow-2xl rounded-xl p-5 sm:p-10" wire:submit.prevent="saveAttendance">

            <div class="grid sm:grid-cols-2 gap-4">

                <x-input-text name="full_name" wire:model.defer="data.full_name" :label="'Ingrese su nombre completo'">
                    @error('data.full_name')
                        <span class="text-red-500">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </x-input-text>
                <x-input-text name="account_number" wire:model.defer="data.account_number"
                    :label="'Ingrese su número de cuenta'">
                    @error('data.account_number')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </x-input-text>
                <x-input-text name="email" wire:model.defer="data.email" :label="'Ingrese su correo institucional'">
                    @error('data.email')
                        <span class="text-red-500">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </x-input-text>
                <x-input-text name="event" wire:model.defer="data.event_id" :label="'Ingrese el código del evento'">
                    @error('data.event_id')
                        <span class="text-red-500">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </x-input-text>

                <div class="flex flex-col">
                    <label class="text-lg text-gray-500">Carreras</label>
                    <select wire:model.defer="data.career" class="rounded-xl p-2 focus:outline-none border-2 mb-2"
                        required>
                        <option value="0" class="text-gray-600 font-bold py-2 text-lg items-center leading-normal"
                            selected>
                            Seleccione la carrera a la que pertenece</option>
                        <option value="Informática Admnistrativa">
                            Informática Admnistrativa
                        </option>
                        <option value="Ingenieria AgroIndustrial">
                            Ingenieria AgroIndustrial
                        </option>
                        <option value="Técnico en Administración Cafetalera">
                            Técnico en Administración Cafetalera
                        </option>
                        <option value="Enfermeria">
                            Enfermeria
                        </option>
                    </select>
                    @error('data.career')
                        <span class="text-red-500">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <x-input-text accept="image/*" type="file" name="image" wire:model.defer="photo"
                    :label="'Adjunte una foto que valide su participación'">
                    @error('data.image')
                        <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </x-input-text>

            </div>

            <div class="flex justify-center gap-2 mt-2">
                <a class="bg-blue-600 p-2 text-white font-bold text-center rounded-lg"
                    href="{{ route('home') }}">Cancelar
                </a>
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
</div>
