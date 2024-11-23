<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
            {
                // Validación de los campos de registro
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'apellido' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Usuario::class],
                    'telefono' => ['required', 'string', 'max:15'],  // Validación para teléfono
                    'direccion' => ['required', 'string', 'max:100'],  // Validación para dirección
                    'notifi_acti' => ['required', 'boolean'],  // Validación para notificaciones
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                // Crear el usuario con tipo 'ciudadano' y otros campos
                $user = Usuario::create([
                    'nombre' => $request->name,
                    'apellidos' => $request->apellido,
                    'email' => $request->email,
                    'telefono' => $request->telefono,  // Almacenar teléfono
                    'direccion' => $request->direccion,  // Almacenar dirección
                    'notifi_acti' => $request->notifi_acti,  // Almacenar el estado de notificaciones
                    'password' => Hash::make($request->password),
                    'tipo' => 'ciudadano',  // Asignar el tipo 'ciudadano'
                ]);

                // Registrar el evento de registro
                event(new Registered($user));

                // Iniciar sesión automáticamente
                Auth::login($user);

                // Redirigir al dashboard
                return redirect(route('reportes.inicio', absolute: false));
            }
}
