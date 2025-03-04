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

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Faltas</h2>
    </x-slot>

    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-700">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Mis Faltas</h2>

        @if ($faltas->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">No tienes faltas registradas.</p>
        @else
            <div class="overflow-x-auto rounded-xl">
                <table class="min-w-full table-auto text-left text-sm text-gray-900 dark:text-white ">
                    <thead>
                        <tr class="border-b bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                            <th class="px-6 py-3 font-medium">Fecha</th>
                            <th class="px-6 py-3 font-medium">Hora</th>
                            <th class="px-6 py-3 font-medium text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faltas as $falta)
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-150">
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($falta->dia)->format('d-m-Y') }}</td>
                                <td class="px-6 py-4">
                                    {{ $horarios[$falta->hora - 1] ?? 'Hora no registrada' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button wire:click="confirmDelete({{ $falta->id }})"
                                        class="px-4 py-0.5 rounded-lg bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200">
                                        <i class="fas fa-trash text-lg"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <x-dialog-modal class="fixed inset-0 z-50 flex justify-center items-center bg-gray-500 bg-opacity-75"
                wire:model="confirmingDelete">
                <x-slot name="title">
                    Eliminar Falta
                </x-slot>

                <x-slot name="content">
                    ¿Estás seguro de eliminar esta falta?
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="$set('confirmingDelete', false)">
                        Cancelar
                    </x-secondary-button>

                    <x-danger-button class="ml-3" wire:click="delete({{ $falta->id }})">
                        Eliminar
                    </x-danger-button>
                </x-slot>
            </x-dialog-modal>
    </div>
    @endif
</div>
</div>
