<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedidos extends Model
{
    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];


    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detallesPedido()
    {
        return $this->hasMany(DetallePedidos::class);
    }
}
