<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'group'  => $this->group,
            'code'   => $this->code,
            'label'  => $this->label,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
