<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'student_id'         => $this->student_id,
            'lab_id'             => $this->lab_id,
            'booking_date'       => $this->booking_date,
            'booking_time_start' => $this->booking_time_start,
            'booking_time_end'   => $this->booking_time_end,
            'booking_status_id'  => $this->booking_status_id,
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
        ];
    }
}
