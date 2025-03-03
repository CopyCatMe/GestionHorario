<div>
    <!-- Botón que abrirá el modal -->
    <x-horario.buttom-usuario />

    <!-- Modal -->
    @if ($modal)
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex justify-center items-center bg-gray-500 bg-opacity-75">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Formulario de Falta</h3>
                        <button wire:click="closeModal" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <form wire:submit.prevent="saveFalta" class="p-4 md:p-5">
                        <!-- Día -->
                        <div class="mt-4">
                            <label for="dia"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Día</label>
                            <input type="date" id="dia" wire:model="dia"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('dia')
                                <!-- Muestra el mensaje de error para el campo "dia" -->
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Selección de horas -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Día completo o
                                tramos de ausencia:</label>

                            <!-- Checkbox Día Completo -->
                            <div class="flex items-center mb-2">
                                <input id="dia_completo" type="checkbox" wire:model="todoElDia"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="dia_completo"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-white">Día completo</label>
                            </div>

                            <!-- Horas (se desactivan si se marca "Día completo") -->
                            <div class="flex flex-col space-y-2">
                                @php
                                    $horarios = [
                                        '8:30-9:30',
                                        '9:30-10:30',
                                        '10:30-11:30',
                                        '12:00-13:00',
                                        '13:00-14:00',
                                        '14:00-15:00',
                                        '16:00-17:00',
                                        '17:00-18:00',
                                        '18:00-19:00',
                                        '19:00-20:00',
                                        '20:00-21:00',
                                        '21:00-22:00',
                                    ];
                                @endphp

                                @foreach ($horarios as $key => $hora)
                                    <div class="flex items-center">
                                        <input id="h{{ $key }}" type="checkbox" wire:model="horas"
                                            value="{{ $hora }}"
                                            @if ($todoElDia) disabled @endif
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="h{{ $key }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-white">{{ $hora }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('horas')
                                <!-- Muestra el mensaje de error para el campo "horas" -->
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="mt-4 text-right">
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Registrar Falta
                            </button>
                        </div>
                    </form>

                    <!-- Mensajes de éxito o error -->
                    @if (session('message'))
                        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
