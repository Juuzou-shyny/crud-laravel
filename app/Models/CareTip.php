<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareTip extends Model
{
    use HasFactory;

    // Especificar qué columnas pueden ser llenadas masivamente
    protected $fillable = ['product_id', 'watering', 'sunlight', 'temperature'];

    // Relación: Un caretip pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

