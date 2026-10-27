<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'batch_id',
        'order_id',
        'recorded_by',
        'movement_type',
        'quantity_kg',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity_kg' => 'decimal:3',
        ];
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
