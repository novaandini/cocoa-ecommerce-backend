<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            [
                'order_id' => 1,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261001-001',
                'transaction_id' => 'MID-20261001-001',
                'payment_method' => 'bank_transfer',
                'transaction_status' => 'settlement',
                'fraud_status' => 'accept',
                'gross_amount' => 2500000,
                'transaction_time' => '2026-10-01 10:00:00',
                'settlement_time' => '2026-10-01 10:05:00',
            ],
            [
                'order_id' => 2,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261002-002',
                'transaction_id' => 'MID-20261002-002',
                'payment_method' => 'credit_card',
                'transaction_status' => 'settlement',
                'fraud_status' => 'accept',
                'gross_amount' => 1800000,
                'transaction_time' => '2026-10-02 10:00:00',
                'settlement_time' => '2026-10-02 10:04:00',
            ],
            [
                'order_id' => 3,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261003-003',
                'transaction_id' => 'MID-20261003-003',
                'payment_method' => 'qris',
                'transaction_status' => 'pending',
                'gross_amount' => 3200000,
                'transaction_time' => '2026-10-03 10:00:00',
            ],
            [
                'order_id' => 4,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261004-004',
                'transaction_id' => 'MID-20261004-004',
                'payment_method' => 'bank_transfer',
                'transaction_status' => 'expire',
                'gross_amount' => 1200000,
                'transaction_time' => '2026-10-04 10:00:00',
                'expiry_time' => '2026-10-05 10:00:00',
            ],
            [
                'order_id' => 5,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261005-005',
                'transaction_id' => 'MID-20261005-005',
                'payment_method' => 'gopay',
                'transaction_status' => 'settlement',
                'fraud_status' => 'accept',
                'gross_amount' => 4500000,
                'transaction_time' => '2026-10-05 10:00:00',
                'settlement_time' => '2026-10-05 10:03:00',
            ],
            [
                'order_id' => 6,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261006-006',
                'transaction_id' => 'MID-20261006-006',
                'payment_method' => 'qris',
                'transaction_status' => 'deny',
                'fraud_status' => 'deny',
                'gross_amount' => 2100000,
                'transaction_time' => '2026-10-06 10:00:00',
            ],
            [
                'order_id' => 7,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261007-007',
                'transaction_id' => 'MID-20261007-007',
                'payment_method' => 'bank_transfer',
                'transaction_status' => 'settlement',
                'fraud_status' => 'accept',
                'gross_amount' => 5000000,
                'transaction_time' => '2026-10-07 10:00:00',
                'settlement_time' => '2026-10-07 10:05:00',
            ],
            [
                'order_id' => 8,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261008-008',
                'transaction_id' => 'MID-20261008-008',
                'payment_method' => 'credit_card',
                'transaction_status' => 'cancel',
                'gross_amount' => 1500000,
                'transaction_time' => '2026-10-08 10:00:00',
            ],
            [
                'order_id' => 9,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261009-009',
                'transaction_id' => 'MID-20261009-009',
                'payment_method' => 'gopay',
                'transaction_status' => 'settlement',
                'fraud_status' => 'accept',
                'gross_amount' => 2750000,
                'transaction_time' => '2026-10-09 10:00:00',
                'settlement_time' => '2026-10-09 10:04:00',
            ],
            [
                'order_id' => 10,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261010-010',
                'transaction_id' => 'MID-20261010-010',
                'payment_method' => 'qris',
                'transaction_status' => 'pending',
                'gross_amount' => 3600000,
                'transaction_time' => '2026-10-10 10:00:00',
            ],
            [
                'order_id' => 11,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261011-011',
                'transaction_id' => 'MID-20261011-011',
                'payment_method' => 'bank_transfer',
                'transaction_status' => 'settlement',
                'fraud_status' => 'accept',
                'gross_amount' => 1900000,
                'transaction_time' => '2026-10-11 10:00:00',
                'settlement_time' => '2026-10-11 10:05:00',
            ],
            [
                'order_id' => 12,
                'payment_gateway' => 'midtrans',
                'gateway_order_id' => 'ORDER-20261012-012',
                'transaction_id' => 'MID-20261012-012',
                'payment_method' => 'credit_card',
                'transaction_status' => 'refund',
                'fraud_status' => 'accept',
                'gross_amount' => 950000,
                'transaction_time' => '2026-10-12 10:00:00',
                'settlement_time' => '2026-10-12 10:05:00',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create([
                'order_id' => $payment['order_id'],
                'payment_gateway' => $payment['payment_gateway'],
                'gateway_order_id' => $payment['gateway_order_id'],
                'transaction_id' => $payment['transaction_id'],
                'payment_method' => $payment['payment_method'],
                'transaction_status' => $payment['transaction_status'],
                'fraud_status' => $payment['fraud_status'] ?? null,
                'gross_amount' => $payment['gross_amount'],
                'transaction_time' => $payment['transaction_time'],
                'settlement_time' => $payment['settlement_time'] ?? null,
                'expiry_time' => $payment['expiry_time'] ?? null,
            ]);
        }
    }
}
