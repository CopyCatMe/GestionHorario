<div class="max-w-7xl mx-auto ">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Guardias</h2>
    </x-slot>

    <div class="p-6 lg:p-8 rounded-lg">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8">
            Guardia del Día
        </h2>

        <div class="flex flex-wrap md:flex-nowrap justify-center gap-4">
            @forelse ($horarios as $dia => $guardias)
                <a href="{{ route('profesores-guardias.show', $dia) }}"
                    class="flex items-center justify-center px-6 py-4 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-md 
                        hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300 focus:ring-2 focus:ring-blue-500 focus:outline-none w-full md:w-1/2 lg:w-1/4">

                    <p class="text-xl font-semibold text-gray-900 dark:text-white text-center">
                        {{ $dia }}
                    </p>
                </a>
            @empty
                <div class="text-center w-full">
                    <p class="text-gray-500 dark:text-gray-400">No hay horarios registrados.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
