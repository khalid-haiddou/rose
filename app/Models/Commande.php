<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commandes';

    protected $fillable = [
    'order_number', 'user_id', 'firstname', 'lastname', 'email', 'phone',
    'address', 'city', 'postcode', 'shipping_method', 'shipping_price',
    'total', 'status', 'payment_method', 'is_payed', 'delivery_number',
    'fidelity_used', 'fidelity_earned',
    ];



    protected $casts = [
        'is_payed' => 'boolean',
        'shipping_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price_ttc')
            ->withTimestamps();
    }

    public function getFidelityEarnedAmountAttribute()
{
    if ($this->status === 'livree') {
        $subtotal = $this->products->sum(fn($product) =>
            $product->pivot->price_ttc * $product->pivot->quantity
        );
        return round($subtotal * 0.10, 2);
    }

    return 0;
}

    public function user()
{
    return $this->belongsTo(User::class);
}

}
