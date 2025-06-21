<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantaDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id', 'tipo', 'riego', 'dificultad', 'luz', 'fertilizacion', 'tolerancia_invierno'
    ];

    public function cuidados()
{
    return $this->belongsToMany(Cuidado::class, 'cuidado_planta');
}

 public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Añadir accesores útiles
    public function getRequerimientosCuidadoAttribute()
    {
        return [
            'riego' => $this->riego,
            'luz' => $this->luz,
            'dificultad' => $this->dificultad
        ];
    }

}
