
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Apellidos -->
        <div class="mt-4">
            <x-input-label for="apellido" :value="__('Apellidos')" />
            <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autocomplete="apellido" />
            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
        </div>
        <!-- Documento de Identidad -->
        <div class="mt-4">
            <x-input-label for="documento_identidad" :value="__('Documento de Identidad')" />
            <x-text-input id="documento_identidad" class="block mt-1 w-full" 
                        type="text" name="documento_identidad" 
                        :value="old('documento_identidad')" required 
                        autocomplete="documento_identidad" maxlength="8" />
            <x-input-error :messages="$errors->get('documento_identidad')" class="mt-2" />
        </div>
        <!-- Ocupación -->
        <div class="mt-4">
            <x-input-label for="ocupacion" :value="__('Ocupación')" />
            <x-text-input id="ocupacion" class="block mt-1 w-full" type="text" name="ocupacion" :value="old('ocupacion')" required autocomplete="ocupacion" />
            <x-input-error :messages="$errors->get('ocupacion')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autocomplete="telefono" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Dirección -->
        <div class="mt-4">
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" required autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Estado de Notificaciones -->
        <div class="mt-4">
            <x-input-label for="notifi_acti" :value="__('Estado de Notificaciones')" />
            <div class="mt-2 space-y-2">
                <label class="flex items-center space-x-2">
                    <input type="radio" name="notifi_acti" value="1" {{ old('notifi_acti') == 1 ? 'checked' : '' }} class="mr-2"> 
                    <span>{{ __('Activo') }}</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="notifi_acti" value="0" {{ old('notifi_acti') == 0 ? 'checked' : '' }} class="mr-2"> 
                    <span>{{ __('Inactivo') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('notifi_acti')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
