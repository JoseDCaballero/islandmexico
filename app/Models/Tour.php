<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no es plural del nombre del modelo, especifícalo aquí
    protected $table = 'tours';

    // Si la tabla tiene campos que no se deben rellenar automáticamente, especifica aquí
    protected $fillable = ['id', 'name', 'price', 'imagen', 'route', 'description'];
}
