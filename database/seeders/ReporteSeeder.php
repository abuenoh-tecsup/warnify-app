<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reporte; // Asegúrate de importar el modelo Reporte
use Carbon\Carbon; // Asegúrate de importar Carbon

class ReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Inserta seis reportes de prueba usando create()
        Reporte::create([
            'id_usuario' => 1,
            'titulo' => 'Colisión entre un automóvil y un bus de transporte público',
            'descripcion' => 'Un choque entre vehículos debido a una maniobra imprudente durante la hora punta, causando congestión y bloqueando los carriles.',
            'ubicacion' => 'Avenida Javier Prado Este, Centro financiero de San Isidro, San Isidro, Lima, Lima Metropolitana, Lima, 15046, Perú',
            'estado_reporte' => 'PENDIENTE',
            'fecha_reporte' => Carbon::now()->subDays(2),
            'fecha_act' => Carbon::now()->subDays(2),
            'id_autoridad' => null,
            'latitud' => -12.0913137,
            'longitud' => -77.0260209,
            'img_incidente' => 'storage/reports_images/seed1.webp',
        ]);

        Reporte::create([
            'id_usuario' => 1,
            'titulo' => 'Atropello de peatón por motocicleta',
            'descripcion' => 'Un motociclista atropelló a un peatón que cruzaba por un paso de cebra, luego de saltarse la luz roja del semáforo.',
            'ubicacion' => 'Avenida Pardo y Aliaga, Santa Isabel, San Isidro, Lima, Lima Metropolitana, Lima, 15073, Perú',
            'estado_reporte' => 'RESUELTO',
            'fecha_reporte' => Carbon::now()->subDays(5),
            'fecha_act' => Carbon::now()->subDays(4),
            'id_autoridad' => null,
            'latitud' => -12.107287,
            'longitud' => -77.0361175,
            'img_incidente' => 'storage/reports_images/seed2.webp',
        ]);

        Reporte::create([
            'id_usuario' => 1,
            'titulo' => 'Caída de motocicleta por mal estado de la vía',
            'descripcion' => 'Un motociclista perdió el control al pasar por una curva resbalosa cerca del puente, cayendo al asfalto y sufriendo lesiones leves.',
            'ubicacion' => 'Puente de los Suspiros, Barranco, Lima, Lima Metropolitana, Lima, 15042, Perú',
            'estado_reporte' => 'PENDIENTE',
            'fecha_reporte' => Carbon::now()->subDays(7),
            'fecha_act' => Carbon::now()->subDays(7),
            'id_autoridad' => null,
            'latitud' => -12.1492232,
            'longitud' => -77.0224648,
            'img_incidente' => 'storage/reports_images/seed3.webp',
        ]);

        Reporte::create([
            'id_usuario' => 1,
            'titulo' => 'Colisión entre camión de carga y automóvil',
            'descripcion' => 'Un automóvil chocó contra un camión detenido por una falla mecánica en plena avenida, causando un gran atasco vehicular.',
            'ubicacion' => 'Avenida Brasil, Jesús María, Lima, Lima Metropolitana, Lima, 15083, Perú',
            'estado_reporte' => 'PENDIENTE',
            'fecha_reporte' => Carbon::now()->subDays(10),
            'fecha_act' => Carbon::now()->subDays(9),
            'id_autoridad' => null,
            'latitud' => -12.0653539,
            'longitud' => -77.0456361,
            'img_incidente' => 'storage/reports_images/seed4.webp',
        ]);

        Reporte::create([
            'id_usuario' => 1,
            'titulo' => 'Resbalón de turista en paso peatonal empedrado',
            'descripcion' => 'Un turista se resbaló en el empedrado de la plaza, causando una fractura en su tobillo y requiriendo atención médica.',
            'ubicacion' => 'Plaza Mayor de Lima, Urbanización Cercado de Lima, Lima, Lima Metropolitana, Lima, Perú',
            'estado_reporte' => 'RESUELTO',
            'fecha_reporte' => Carbon::now()->subDays(3),
            'fecha_act' => Carbon::now()->subDays(2),
            'id_autoridad' => null,
            'latitud' => -12.04593345,
            'longitud' => -77.03055592743846,
            'img_incidente' => 'storage/reports_images/seed5.webp',
        ]);

        Reporte::create([
            'id_usuario' => 1,
            'titulo' => 'Choque entre automóvil y bus de transporte público',
            'descripcion' => 'Un automóvil no respetó la señal de alto en la intersección y chocó con un bus, dejando varios heridos leves.',
            'ubicacion' => 'Avenida La Marina, San Miguel, Lima, Lima Metropolitana, Lima, 15087, Perú',
            'estado_reporte' => 'PENDIENTE',
            'fecha_reporte' => Carbon::now()->subDays(1),
            'fecha_act' => Carbon::now()->subDays(1),
            'id_autoridad' => null,
            'latitud' => -12.075711150525583,
            'longitud' => -77.0961229673866,
            'img_incidente' => 'storage/reports_images/seed6.webp',
        ]);
    }
}
