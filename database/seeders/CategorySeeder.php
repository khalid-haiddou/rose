<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Caves à vin (Pas de sous-catégories)
        Category::create(['nom' => 'Caves à vin', 'slug' => 'caves-a-vin']);

        // 2. Verrerie avec sous-catégories
        $verrerie = Category::create(['nom' => 'Verrerie', 'slug' => 'verrerie']);
        $verrerie->children()->createMany([
            ['nom' => 'Verres à vins', 'slug' => 'verres-a-vins'],
            ['nom' => 'Verres à bière', 'slug' => 'verres-a-biere'],
            ['nom' => 'Verres à spiritueux', 'slug' => 'verres-a-spiritueux'],
            ['nom' => 'Verres à shots', 'slug' => 'verres-a-shots'],
            ['nom' => 'Verres à cocktails', 'slug' => 'verres-a-cocktails'],
            ['nom' => 'Verres à eau', 'slug' => 'verres-a-eau'],
            ['nom' => 'Carafes', 'slug' => 'carafes'],
        ]);

        // 3–7 Other main categories
        Category::create(['nom' => 'Ameublement et Jardin', 'slug' => 'ameublement-et-jardin']);
        Category::create(['nom' => 'Accessoires de Vin', 'slug' => 'accessoires-de-vin']);
        Category::create(['nom' => 'Mini-Réfrigérateurs et Frigos', 'slug' => 'mini-refrigerateurs-et-frigos']);
        Category::create(['nom' => 'Caves à cigares et cendriers', 'slug' => 'caves-a-cigares-et-cendriers']);
        Category::create(['nom' => 'Univers du Cocktail', 'slug' => 'univers-du-cocktail']);
    }
}
