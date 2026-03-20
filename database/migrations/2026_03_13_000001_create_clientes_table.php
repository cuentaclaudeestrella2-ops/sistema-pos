<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('razon');
            $table->string('comercial')->nullable();
            $table->string('tipoDoc')->default('RUC');
            $table->string('nroDoc');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('direccion')->nullable();
            $table->string('distrito')->nullable();
            $table->string('ciudad')->default('Lima');
            $table->integer('credDias')->default(0);
            $table->decimal('limCredito', 10, 2)->default(0);
            $table->string('listaPrecio')->default('1');
            $table->string('estado')->default('activo');
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
