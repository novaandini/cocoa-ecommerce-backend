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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();

            $table->string('batch_code', 100)->unique();
            $table->string('origin')->nullable();
            $table->date('harvest_date')->nullable();
            $table->date('production_date')->nullable();
            $table->decimal('initial_quantity_kg', 12, 3);
            $table->decimal('available_quantity_kg', 12, 3);
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['product_id', 'production_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
