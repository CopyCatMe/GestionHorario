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
                    oninput="validatePassword()"
                />
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror

                <!-- Validaciones en tiempo real -->
                <ul class="mt-2 text-sm text-gray-600" id="password-rules">
                    <li id="rule-length" class="flex items-center">
                        <span class="w-5 h-5 inline-block mr-2 text-gray-400">⚠️</span> Mínimo 8 caracteres
                    </li>
                    <li id="rule-lowercase" class="flex items-center">
                        <span class="w-5 h-5 inline-block mr-2 text-gray-400">⚠️</span> Una letra minúscula
                    </li>
                    <li id="rule-uppercase" class="flex items-center">
                        <span class="w-5 h-5 inline-block mr-2 text-gray-400">⚠️</span> Una letra mayúscula
                    </li>
                    <li id="rule-number" class="flex items-center">
                        <span class="w-5 h-5 inline-block mr-2 text-gray-400">⚠️</span> Un número
                    </li>
                    <li id="rule-special" class="flex items-center">
                        <span class="w-5 h-5 inline-block mr-2 text-gray-400">⚠️</span> Un carácter especial (@$!%*?&.)
                    </li>
                </ul>
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
                    oninput="validatePasswordMatch()"
                />
                @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
                <p id="password-match-message" class="text-sm mt-2"></p>
            </div>

            <!-- Botón de guardar la contraseña -->
            <div class="flex items-center justify-end mt-4">
                <x-button 
                    class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    id="submit-button"
                    disabled
                >
                    {{ __('Guardar Contraseña') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <!-- Script de validación -->
    <script>
        function validatePassword() {
            let password = document.getElementById("password").value;
            let rules = {
                length: password.length >= 8,
                lowercase: /[a-z]/.test(password),
                uppercase: /[A-Z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[@$!%*?&.]/.test(password),
            };

            // Actualizar iconos y colores
            for (let rule in rules) {
                let element = document.getElementById(`rule-${rule}`);
                let icon = element.querySelector("span");

                if (rules[rule]) {
                    icon.textContent = "✅";
                    icon.classList.remove("text-gray-400");
                    icon.classList.add("text-green-600");
                } else {
                    icon.textContent = "⚠️";
                    icon.classList.remove("text-green-600");
                    icon.classList.add("text-gray-400");
                }
            }

            validatePasswordMatch();
        }

        function validatePasswordMatch() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("password_confirmation").value;
            let message = document.getElementById("password-match-message");
            let submitButton = document.getElementById("submit-button");

            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    message.textContent = "Las contraseñas coinciden ✅";
                    message.classList.remove("text-red-600");
                    message.classList.add("text-green-600");
                } else {
                    message.textContent = "Las contraseñas no coinciden ⚠️";
                    message.classList.remove("text-green-600");
                    message.classList.add("text-red-600");
                }
            } else {
                message.textContent = "";
            }

            // Habilitar el botón solo si todas las reglas se cumplen y las contraseñas coinciden
            let rulesPassed = document.querySelectorAll("#password-rules span.text-green-600").length === 5;
            submitButton.disabled = !(rulesPassed && password === confirmPassword);
        }
    </script>
</x-guest-layout>
