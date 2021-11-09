<div class="flex flex-col">
    <label class="text-lg text-gray-500">{{ $label }}</label>
    <input {{ $attributes }} class="rounded-xl p-2 focus:outline-none border-2 mb-2">
    {{ $slot }}
</div>