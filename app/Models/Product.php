<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'description_longue',
        'image',
        'prix_ht',
        'prix_ttc',
        'stock',
        'reference',
        'is_new',
        'remise',
        'category_id',
        'subcategory_id',
    ];

    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    
    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    
    public function characteristics()
    {
        return $this->hasMany(ProductCharacteristic::class);
    }
    public function reviews()
{
    return $this->hasMany(Review::class);
}


public function commandes()
{
    return $this->belongsToMany(Commande::class)
                ->withPivot('quantity', 'price_ttc')
                ->withTimestamps();
}

}
