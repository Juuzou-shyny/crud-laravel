<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetallePedidos;

class Pedido extends Model
{
    use HasFactory;

    const ESTADO_CARRITO = 'carrito';
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_ENVIADO = 'enviado';
    const ESTADO_ENTREGADO = 'entregado';

    protected $fillable = ['user_id', 'fecha_pedido', 'total', 'estado'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detallesPedido()
    {
        return $this->hasMany(DetallePedidos::class);
    }


}
