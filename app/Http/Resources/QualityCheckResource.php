<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QualityCheckResource extends JsonResource
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
            'batch_id' => $this->batch_id,
            'checked_by' => $this->checked_by,
            'moisture_percentage' => $this->moisture_percentage,
            'fermentation_percentage' => $this->fermentation_percentage,
            'defective_beans_percentage' => $this->defective_beans_percentage,
            'quality_result' => $this->quality_result,
            'notes' => $this->notes,
            'checked_at' => $this->checked_at?->toISOString(),
            'batch' => new BatchResource($this->whenLoaded('batch')),
            'checked_by_user' => new UserResource($this->whenLoaded('checkedBy')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
