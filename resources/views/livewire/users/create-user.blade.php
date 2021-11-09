<div class="p-5">
    @if ($editMode == false)
        <h1 class="font-bold text-xl text-center">Crear Usuario</h1>
    @endif
    @if ($editMode == true)
        <h1 class="font-bold text-xl text-center">Editar Usuario</h1>
    @endif

    <form wire:submit.prevent="saveUser">

        <div class="flex flex-col gap-4">

            <x-input-text wire:model.defer="data.name" :label="'Ingrese el nombre del usuario'">
                @error('data.name')
                    <span class="text-red-500">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </x-input-text>
            <x-input-text wire:model.defer="data.email" :label="'Ingrese un correo electrónico'">
                @error('data.email')
                    <span class="text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </x-input-text>

            @if ($editMode == false)
                <x-input-text type="text" wire:model.defer="data.password" :label="'Ingrese una contraseña'">
                    @error('data.password')
                        <span class="text-red-500">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </x-input-text>

                <x-input-text type="text" wire:model.defer="data.password_confirmation"
                    :label="'Confirme la Contraseña'">
                    @error('data.password_confirmation')
                        <span class="text-red-500">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </x-input-text>
            @endif

            <label for="is_admin" class="flex items-center justify-self-center">
                <x-jet-checkbox id="is_admin" wire:model.defer="data.is_admin" />
                <span class="ml-2 text-sm text-gray-600">Administrador</span>
            </label>

        </div>

        <div class="flex justify-center gap-2 mt-2">
            <button class="bg-blue-600 p-2 text-white font-bold text-center rounded-lg" type="button" wire:click='close()'>
                Cancelar
            </button>
            <button class="bg-yellow-500 p-2 text-white font-bold text-center rounded-lg" type="submit">
                {{$editMode ? "Editar" : "Registrar"}}
                <svg wire:loading.delay class="animate-spin w-6 h-6 mx-auto" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>

        </div>

    </form>

</div>
