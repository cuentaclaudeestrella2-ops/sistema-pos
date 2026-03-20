<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon', 'comercial', 'tipoDoc', 'nroDoc', 'telefono', 'email', 'direccion', 
        'distrito', 'ciudad', 'credDias', 'limCredito', 'listaPrecio', 'estado', 'notas'
    ];
}
