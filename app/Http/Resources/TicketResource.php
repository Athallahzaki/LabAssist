<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'student_id'        => $this->student_id,
            'lab_id'            => $this->lab_id,
            'assigned_admin_id' => $this->assigned_admin_id,
            'title'             => $this->title,
            'description'       => $this->description,
            'ticket_status_id'  => $this->ticket_status_id,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
