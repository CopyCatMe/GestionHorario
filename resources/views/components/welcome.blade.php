<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
        Bienvenido, {{ auth()->user()->name }}!
    </h1>

    <div class="mt-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            Su horario:
        </h2>
        @if(auth()->user()->horarios && auth()->user()->horarios->isNotEmpty())
            <div class="overflow-x-auto mt-3 flex justify-center mb-4">
                <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-300">
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">Hora</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">Lunes</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">Martes</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">Miércoles</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">Jueves</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">Viernes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Las horas son las mismas para todos los días
                            $horas = ['1', '2', '3', '4', '5', '6'];
                        @endphp
    
                        @foreach($horas as $hora)
                            <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-300">{{ $hora }}º</td>
                                
                                @foreach(['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'] as $dia)
                                    @php
                                        // Filtrar los horarios de un día específico y de la hora actual
                                        $horariosPorDia = auth()->user()->horarios->where('dia', $dia)->where('hora', $hora);
                                    @endphp
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-300">
                                        @if($horariosPorDia->isNotEmpty())
                                            @foreach($horariosPorDia as $h)
                                                {{ $h->aula_numero }}<br>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="mt-3 text-gray-500 dark:text-gray-400">No tiene horarios asignados.</p>
        @endif         
    </div>
    


    <div class=" bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                    <a href="#">Formulario</a>
                </h2>
            </div>
    
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                Registra tu ausencia en el horario correspondiente del día en que no podrás asistir a tus clases.
            </p>
    
            <p class="mt-4 text-sm">
                <a href="#" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                    Completa el formulario
    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500 dark:fill-indigo-200">
                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                    </svg>
                </a>
            </p>
        </div>
    
        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.75 3.75M12 14l-6.75 3.75" />
                </svg>
                <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                    <a href="#">Horarios de Guardias</a>
                </h2>
            </div>
    
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                Aquí podrás consultar los horarios de las guardias asignadas para los profesores.
                Si necesitas realizar algún cambio o no puedes cumplir con una guardia, por favor notifícalo lo antes posible.
            </p>
    
            <p class="mt-4 text-sm">
                <a href="https://laracasts.com" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                    Ver mis horarios de guardia
    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500 dark:fill-indigo-200">
                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                    </svg>
                </a>
            </p>
        </div>
    
</div>
