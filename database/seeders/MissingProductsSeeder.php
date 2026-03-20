<?php

namespace Database\Seeders;

use App\Models\Inventario;
use Illuminate\Database\Seeder;

class MissingProductsSeeder extends Seeder
{
    public function run(): void
    {
        Inventario::firstOrCreate(
            ['codigo' => 'FLT-012'],
            [
                'nombre' => 'Filtro de Aceite Original Toyota Yaris/Corolla',
                'categoria' => 'Filtros',
                'marca' => 'Toyota Gen',
                'unidad' => 'Unidad',
                'precio1' => 35.00,
                'precio2' => 30.00,
                'precio3' => 28.00,
                'stock' => 45,
                'stockMin' => 10,
                'estado' => 'activo'
            ]
        );

        Inventario::firstOrCreate(
            ['codigo' => 'ELC-003'],
            [
                'nombre' => 'Bujía Iridium CR8EIX para Moto de alto cilindraje',
                'categoria' => 'Eléctrico',
                'marca' => 'NGK',
                'unidad' => 'Unidad',
                'precio1' => 45.00,
                'precio2' => 38.00,
                'precio3' => 35.00,
                'stock' => 50,
                'stockMin' => 15,
                'estado' => 'activo'
            ]
        );

        Inventario::firstOrCreate(
            ['codigo' => 'ACC-101'],
            [
                'nombre' => 'Faro Delantero LED Ojo de Ángel 7 Pulgadas',
                'categoria' => 'Accesorios',
                'marca' => 'HJG',
                'unidad' => 'Unidad',
                'precio1' => 120.00,
                'precio2' => 100.00,
                'precio3' => 90.00,
                'stock' => 1,
                'stockMin' => 2,
                'estado' => 'activo'
            ]
        );
    }
}
