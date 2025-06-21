<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuidado extends Model
{

    use HasFactory;

    
    public function plantas()
{
    return $this->belongsToMany(PlantaDetalle::class, 'cuidado_planta');
}

}
