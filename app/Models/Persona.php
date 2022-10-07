<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    /* protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'telefono'
    ]; */

    protected $guarded = [];

    // Evita que se muestren estos campos al devolver la respuesta de la api 
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
