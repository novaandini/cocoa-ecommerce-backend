<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code', 50)->unique();
            $table->string('product_name');

            $table->enum('product_type', [
                'fermented',
                'non_fermented',
            ]);

            $table->enum('grade', ['A', 'B', 'C']);
            $table->text('description')->nullable();
            $table->decimal('price_per_kg', 15, 2);
            $table->string('image_url', 2048)->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
