<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'nombre_apellido' => 'Usuario Prueba',
            'email' => 'usuario.prueba@example.com',
            'telefono' => '123456789',
            'direccion' => '123 Calle Falsa',
            'fecha_registro' => now(),
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
        ]);
        Usuario::create([
            'nombre_apellido' => 'Alvaro Bueno',
            'email' => 'alvaro.bueno@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 123',
            'fecha_registro' => now(),
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
        ]);
        Usuario::create([
            'nombre_apellido' => 'Eduardo Bullon',
            'email' => 'eduardo.bullon@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 123',
            'fecha_registro' => now(),
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
        ]);
        Usuario::create([
            'nombre_apellido' => 'Sonaly Sifuentes',
            'email' => 'sonaly.sifuentes@tecsup.edu.pe',
            'telefono' => '123456789',
            'direccion' => 'Calle 123',
            'fecha_registro' => now(),
            'notifi_acti' => true,
            'password' => bcrypt('Tecsup2024'),
        ]);
    }
}
