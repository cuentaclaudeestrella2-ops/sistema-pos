<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clientes Demo
        \App\Models\Cliente::create([
            'razon' => 'Lubricentros El Pistón S.A.C.',
            'comercial' => 'El Pistón',
            'tipoDoc' => 'RUC',
            'nroDoc' => '20123456781',
            'telefono' => '988111222',
            'email' => 'compras@elpiston.pe',
            'direccion' => 'Av. Argentina 1500, Callao',
            'listaPrecio' => '2',
            'estado' => 'activo'
        ]);

        \App\Models\Cliente::create([
            'razon' => 'Juan Perez (Mecánico Independiente)',
            'comercial' => '',
            'tipoDoc' => 'DNI',
            'nroDoc' => '44556677',
            'telefono' => '987123654',
            'email' => 'juan.mecanico@gmail.com',
            'direccion' => 'Av. Brasil 230',
            'listaPrecio' => '1',
            'estado' => 'activo'
        ]);

        // Inventario Demo
        \App\Models\Inventario::create([
            'codigo' => 'MOT-001',
            'nombre' => 'Aceite Motor Motul 7100 10W40 1L (Sintético)',
            'categoria' => 'Lubricantes',
            'marca' => 'Motul',
            'unidad' => 'Litro',
            'precio1' => 65.00,
            'precio2' => 58.00,
            'precio3' => 55.00,
            'stock' => 24,
            'stockMin' => 6,
            'estado' => 'activo'
        ]);

        \App\Models\Inventario::create([
            'codigo' => 'FRN-010',
            'nombre' => 'Pastillas de Freno Delantero Ceramic (Brembo)',
            'categoria' => 'Frenos',
            'marca' => 'Brembo',
            'unidad' => 'Juego',
            'precio1' => 120.00,
            'precio2' => 105.00,
            'precio3' => 95.00,
            'stock' => 8,
            'stockMin' => 3,
            'estado' => 'activo'
        ]);
        
        \App\Models\Inventario::create([
            'codigo' => 'TRA-005',
            'nombre' => 'Kit de Arrastre Racing (Cadena+Piñón+Corona)',
            'categoria' => 'Transmisión',
            'marca' => 'RIZOMA',
            'unidad' => 'Kit',
            'precio1' => 280.00,
            'precio2' => 250.00,
            'precio3' => 230.00,
            'stock' => 2,
            'stockMin' => 2,
            'estado' => 'activo'
        ]);
    }
}
