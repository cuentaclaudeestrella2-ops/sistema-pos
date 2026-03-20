<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['ingreso', 'egreso'])->default('ingreso');
            $table->string('metodo')->default('Efectivo');
            $table->string('concepto');
            $table->decimal('monto', 10, 2);
            $table->string('referencia')->nullable();
            $table->string('fecha')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
