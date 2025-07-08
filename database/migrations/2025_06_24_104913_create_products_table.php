<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Products table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('description_longue')->nullable(); // for full tab description
            $table->string('image')->nullable(); // main image
            $table->decimal('prix_ht', 8, 2);
            $table->decimal('prix_ttc', 8, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->string('reference')->unique();
            $table->boolean('is_new')->default(false);
            $table->integer('remise')->nullable(); // discount %

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->timestamps();
        });

        // Product images table (gallery)
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });

        // Product characteristics table (tech specs)
        Schema::create('product_characteristics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('label');
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_characteristics');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};
