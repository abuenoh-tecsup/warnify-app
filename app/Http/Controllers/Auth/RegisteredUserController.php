<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Ciudadano;  // Importa el modelo Ciudadano
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
            'telefono' => ['required', 'string', 'max:15'],
            'direccion' => ['required', 'string', 'max:100'],
            'notifi_acti' => ['required', 'boolean'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Validación para Documento de Identidad
            'documento_identidad' => ['required', 'string', 'max:8'],
            'ocupacion' => ['required', 'string', 'max:255'],
        ]);

        // Crear el usuario con tipo ciudadano
        $user = Usuario::create([
            'nombre' => $request->name,
            'apellidos' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'notifi_acti' => $request->notifi_acti,
            'password' => Hash::make($request->password),
            'tipo' => 'ciudadano',
        ]);

        // Crear el registro correspondiente en la tabla ciudadano
        Ciudadano::create([
            'id_usuario' => $user->id_usuario,
            'documento_identidad' => $request->documento_identidad,
            'ocupacion' => $request->ocupacion,
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(route('reportes.inicio', absolute: false));
    }
}
