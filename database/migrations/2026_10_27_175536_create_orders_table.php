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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_number', 50)->unique();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->restrictOnDelete();

            $table->enum('order_status', [
                'submitted',
                'confirmed',
                'processing',
                'quality_check',
                'packed',
                'ready_to_ship',
                'shipped',
                'delivered',
                'completed',
                'cancelled',
            ])->default('submitted');

            $table->enum('payment_status', [
                'unpaid',
                'partially_paid',
                'pending_verification',
                'paid',
                'refunded',
            ])->default('unpaid');

            $table->text('shipping_address');
            $table->decimal('shipping_fee', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->text('customer_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->dateTime('ordered_at')->useCurrent();

            $table->timestamps();

            $table->index(['customer_id', 'order_status']);
            $table->index(['payment_status', 'ordered_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
