<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    use HasFactory;


    protected $fillable = [
        'nombre', 'descripcion', 'precio', 'stock', 'imagen_url', 'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }


    public function detallesPedido()
    {
        return $this->hasMany(DetallePedidos::class);
    }

      public function detallesPlanta()
    {
        return $this->hasOne(PlantaDetalle::class);
    }

    public function getEsPlantaAttribute()
    {
        return $this->detallesPlanta !== null;
    }

    public function getTipoAttribute()
    {
        return $this->esPlanta ? 'Planta' : 'Producto';
    }
}
