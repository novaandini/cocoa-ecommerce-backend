<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_gateway',
        'gateway_order_id',
        'transaction_id',
        'payment_method',
        'transaction_status',
        'fraud_status',
        'gross_amount',
        'currency',
        'transaction_time',
        'settlement_time',
        'expiry_time',
        'gateway_response',
        'failure_reason',
    ];

    protected function casts(): array
    {
        return [
            'gross_amount' => 'decimal:2',
            'transaction_time' => 'datetime',
            'settlement_time' => 'datetime',
            'expiry_time' => 'datetime',
            'gateway_response' => 'array',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
