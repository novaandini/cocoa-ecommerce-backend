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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->unique()
                ->constrained('orders')
                ->restrictOnDelete();

            $table->string('courier_name')->nullable();
            $table->string('tracking_number', 100)->nullable();
            $table->text('shipping_address');

            $table->enum('shipment_status', [
                'pending',
                'packed',
                'shipped',
                'in_transit',
                'delivered',
                'failed',
                'returned',
            ])->default('pending');

            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('estimated_arrival')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
