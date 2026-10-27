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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->restrictOnDelete();

            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->restrictOnDelete();

            $table->foreignId('recorded_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->enum('movement_type', [
                'in',
                'out',
                'adjustment',
            ]);

            $table->decimal('quantity_kg', 12, 3);
            $table->text('notes')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->index(['batch_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
