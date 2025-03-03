<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <x-horario.application-logo class="block h-10 w-auto" />

    <h1 class="mt-8 w-[95%] mx-auto text-2xl font-medium text-gray-900 dark:text-white">
        Bienvenido, {{ auth()->user()->name }}!
    </h1>

    {{-- Componente para el horario del profesor --}}
    <x-horario.horario-usuario :usuario="auth()->user()" />
        
    {{-- Componente para el formulario de falta --}}
    <livewire:formulario-falta />

</div>
