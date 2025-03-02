<div class="mt-6 w-full max-w-5xl mx-auto">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
        Su horario:
    </h2>

    @if ($usuario->horarios && $usuario->horarios->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 dark:border-gray-600 shadow-lg rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-300">
                        <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left">Hora</th>
                        @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                            <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left">
                                {{ $dia }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $horas = ['1', '2', '3', '4', '5', '6'];
                    @endphp

                    @foreach ($horas as $hora)
                        <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                            <td
                                class="px-4 py-3 border border-gray-300 dark:border-gray-600 font-semibold text-gray-800 dark:text-gray-300">
                                {{ $hora }}º
                            </td>

                            @foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'] as $dia)
                                @php
                                    $horariosPorDia = $usuario->horarios->where('dia', $dia)->where('hora', $hora);
                                @endphp
                                <td
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-300 text-center">
                                    @if ($horariosPorDia->isNotEmpty())
                                        @foreach ($horariosPorDia as $h)
                                            <span
                                                class="inline-block bg-indigo-100 dark:bg-indigo-700 text-indigo-900 dark:text-indigo-200 px-2 py-1 rounded-md text-sm">
                                                {{ $h->aula_numero }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="mt-3 text-gray-500 dark:text-gray-400 text-center">No tiene horarios asignados.</p>
    @endif
</div>
