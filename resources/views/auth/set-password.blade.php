<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <form method="POST" action="{{ url('password/set') }}">
            @csrf

            <!-- Campo para la nueva contraseña -->
            <div>
                <x-label for="password" value="{{ __('Nueva contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Campo para confirmar la contraseña -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <!-- Botón de guardar la contraseña -->
            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Guardar contraseña') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
