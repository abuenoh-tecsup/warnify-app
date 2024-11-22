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
            'id_usuario' => $ciudadano1->id_usuario,
            'documento_identidad' => '87654321',
            'ocupacion' => 'Ingeniero',
        ]);

        $ciudadano2 = Usuario::create([
            'nombre' => 'Eduardo',
            'apellidos' => 'Bullon',
            'email' => 'eduardo.bullon@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 123',
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
            'tipo' => 'ciudadano',
        ]);
        Ciudadano::create([
            'id_usuario' => $ciudadano2->id_usuario,
            'documento_identidad' => '12345678',
            'ocupacion' => 'Inspector',
        ]);

        $ciudadano3 = Usuario::create([
            'nombre' => 'Sonaly',
            'apellidos' => 'Sifuentes',
            'email' => 'sonaly.sifuentes@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 123',
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
            'tipo' => 'ciudadano',
        ]);
        Ciudadano::create([
            'id_usuario' => $ciudadano3->id_usuario,
            'documento_identidad' => '11223344',
            'ocupacion' => 'Profesora',
        ]);

        // Crear un usuario de tipo 'autoridad'
        $autoridad1 = Usuario::create([
            'nombre' => 'Autoridad',
            'apellidos' => 'Test',
            'email' => 'autoridad@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 456',
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
            'tipo' => 'autoridad',
        ]);
        Autoridad::create([
            'id_usuario' => $autoridad1->id_usuario,
            'cargo' => 'Inspector',
            'tipo_autoridad' => 'Policial',
        ]);

        // Crear un usuario de tipo 'moderador'
        $moderador1 = Usuario::create([
            'nombre' => 'Moderador',
            'apellidos' => 'Test',
            'email' => 'moderador@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 789',
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
