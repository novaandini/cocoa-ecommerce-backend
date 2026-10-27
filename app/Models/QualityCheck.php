<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualityCheck extends Model
{
    protected $fillable = [
        'batch_id',
        'checked_by',
        'moisture_percentage',
        'fermentation_percentage',
        'defective_beans_percentage',
        'quality_result',
        'notes',
        'checked_at',
    ];

    protected function casts(): array
    {
        return [
            'moisture_percentage' => 'decimal:2',
            'fermentation_percentage' => 'decimal:2',
            'defective_beans_percentage' => 'decimal:2',
            'checked_at' => 'datetime',
        ];
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function checkedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}
