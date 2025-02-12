<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'category_id'];
    public function category()
{
    return $this->belongsTo(Category::class);
}

public function careTips()
{
    return $this->hasMany(CareTip::class); // Solo aplicable a productos de la categoría "Planta"
}

public function carts()
{
    return $this->belongsToMany(User::class, 'carts')->withPivot('quantity');
}

public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}



    // 🔥 Al eliminar una planta, también se elimina su caretip automáticamente
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->caretip()->delete();
        });
    }

}
