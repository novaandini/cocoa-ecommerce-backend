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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->restrictOnDelete();

            $table->string('payment_gateway', 50);
            $table->string('gateway_order_id', 100)->unique();
            $table->string('transaction_id', 100)->nullable()->unique();
            $table->string('payment_method', 50)->nullable();

            $table->enum('transaction_status', [
                'pending',
                'capture',
                'settlement',
                'deny',
                'cancel',
                'expire',
                'refund',
                'failure',
            ])->default('pending');

            $table->enum('fraud_status', [
                'accept',
                'challenge',
                'deny',
            ])->nullable();

            $table->decimal('gross_amount', 15, 2);
            $table->char('currency', 3)->default('IDR');
            $table->dateTime('transaction_time')->nullable();
            $table->dateTime('settlement_time')->nullable();
            $table->dateTime('expiry_time')->nullable();
            $table->json('gateway_response')->nullable();
            $table->text('failure_reason')->nullable();

            $table->timestamps();

            $table->index(['order_id', 'transaction_status']);
            $table->index(['payment_gateway', 'transaction_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
