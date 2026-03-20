<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->string('categoria')->nullable();
            $table->string('marca')->nullable();
            $table->string('unidad')->default('Unidad');
            $table->decimal('precio1', 10, 2)->default(0);
            $table->decimal('precio2', 10, 2)->default(0);
            $table->decimal('precio3', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('stockMin')->default(5);
            $table->integer('stockMax')->default(100);
            $table->string('ubicacion')->nullable();
            $table->string('estado')->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
