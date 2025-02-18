<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <form method="POST" action="{{ url('password/set') }}" class="space-y-6">
            @csrf

            <!-- Campo para la nueva contraseña -->
            <div>
                <x-label for="password" value="{{ __('Nueva Contraseña') }}" />
                <x-input 
                    id="password" 
                    class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password"
                    placeholder="Ingrese su nueva contraseña"
                />
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo para confirmar la contraseña -->
            <div>
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-input 
                    id="password_confirmation" 
                    class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="Confirme su nueva contraseña"
                />
                @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botón de guardar la contraseña -->
            <div class="flex items-center justify-end mt-4">
                <x-button class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Guardar Contraseña') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
