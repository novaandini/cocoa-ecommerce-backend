<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'user_id' => $this->user_id,
            'company_name' => $this->company_name,
            'address' => $this->address,
            'tax_id' => $this->tax_id,
            'allow_public_company_name' => $this->allow_public_company_name,
            'is_active' => $this->whenLoaded('user', fn (): bool => (bool) $this->user->is_active),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
