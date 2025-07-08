<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commandes';

    protected $fillable = [
        'order_number', // add this
        'firstname', 'lastname', 'email', 'phone', 'address',
        'city', 'postcode', 'shipping_method', 'shipping_price',
        'total', 'status', 'payment_method', 'is_payed'
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

}
