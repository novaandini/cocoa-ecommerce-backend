<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'batch_code' => $this->batch_code,
            'origin' => $this->origin,
            'harvest_date' => $this->harvest_date?->toDateString(),
            'production_date' => $this->production_date?->toDateString(),
            'initial_quantity_kg' => $this->initial_quantity_kg,
            'available_quantity_kg' => $this->available_quantity_kg,
            'notes' => $this->notes,
            'product' => new ProductResource($this->whenLoaded('product')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
