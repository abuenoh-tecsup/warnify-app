<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Usuario;
use App\Models\Ciudadano;
use App\Models\Autoridad;
use App\Models\Moderador;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuarios de tipo 'ciudadano'
        $ciudadano1 = Usuario::create([
            'nombre' => 'Usuario',
            'apellidos' => 'Prueba',
            'email' => 'usuario.prueba@example.com',
            'telefono' => '123456789',
            'direccion' => '123 Calle Falsa',
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
            'tipo' => 'ciudadano',
        ]);
        Ciudadano::create([
            'id_usuario' => $ciudadano1->id_usuario,
            'documento_identidad' => '12345678',
            'ocupacion' => 'Estudiante',
        ]);

        $ciudadano2 = Usuario::create([
            'nombre' => 'Alvaro',
            'apellidos' => 'Bueno',
            'email' => 'alvaro.bueno@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 123',
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
            'tipo' => 'ciudadano',
        ]);
        Ciudadano::create([
            'id_usuario' => $ciudadano2->id_usuario,
            'documento_identidad' => '87654321',
            'ocupacion' => 'Ingeniero',
        ]);

        // Crear usuarios de tipo 'autoridad'
        $autoridad1 = Usuario::create([
            'nombre' => 'Eduardo',
            'apellidos' => 'Bullon',
            'email' => 'eduardo.bullon@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 123',
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
            'tipo' => 'autoridad',
        ]);
        Autoridad::create([
            'id_usuario' => $autoridad1->id_usuario,
            'cargo' => 'Inspector',
            'tipo_autoridad' => 'Policial',
        ]);

        $autoridad2 = Usuario::create([
            'nombre' => 'Sonaly',
            'apellidos' => 'Sifuentes',
            'email' => 'sonaly.sifuentes@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 123',
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
            'tipo' => 'autoridad',
        ]);
        Autoridad::create([
            'id_usuario' => $autoridad2->id_usuario,
            'cargo' => 'Jefe de Seguridad',
            'tipo_autoridad' => 'Gobierno',
        ]);

        // Crear usuarios de tipo 'moderador'
        $moderador1 = Usuario::create([
            'nombre' => 'Carlos',
            'apellidos' => 'Mendoza',
            'email' => 'carlos.mendoza@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 456',
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
            'tipo' => 'moderador',
        ]);
        Moderador::create([
            'id_usuario' => $moderador1->id_usuario,
            'area_supervision' => 'Reporte de Incidentes',
        ]);
    }
}
