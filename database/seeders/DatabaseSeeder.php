<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Clientes Demo
        \App\Models\Cliente::firstOrCreate(
            ['nroDoc' => '20123456781'],
            [
                'razon' => 'Lubricentros El Pistón S.A.C.',
                'comercial' => 'El Pistón',
                'tipoDoc' => 'RUC',
                'telefono' => '988111222',
                'email' => 'compras@elpiston.pe',
                'direccion' => 'Av. Argentina 1500, Callao',
                'listaPrecio' => '2',
                'estado' => 'activo'
            ]
        );

        \App\Models\Cliente::firstOrCreate(
            ['nroDoc' => '44556677'],
            [
                'razon' => 'Juan Perez (Mecánico Independiente)',
                'comercial' => '',
                'tipoDoc' => 'DNI',
                'telefono' => '987123654',
                'email' => 'juan.mecanico@gmail.com',
                'direccion' => 'Av. Brasil 230',
                'listaPrecio' => '1',
                'estado' => 'activo'
            ]
        );

        \App\Models\Cliente::firstOrCreate(
            ['nroDoc' => '10445566778'],
            [
                'razon' => 'Moto GP Parts EIRL',
                'comercial' => 'Moto GP',
                'tipoDoc' => 'RUC',
                'telefono' => '999333444',
                'email' => 'ventas@motogpparts.pe',
                'direccion' => 'Av. La Marina 800',
                'listaPrecio' => '3',
                'estado' => 'activo'
            ]
        );

        // Full Stock - ALL products
        $this->call(FullStockSeeder::class);
    }
}
