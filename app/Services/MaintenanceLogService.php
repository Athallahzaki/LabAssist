<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Status;
use App\Models\MaintenanceLog;
use Illuminate\Support\Facades\DB;

class MaintenanceLogService
{
    public function create(
        Ticket $ticket,
        int $adminId,
        string $description,
        bool $isFinal = false
    )
    {
        return DB::transaction(function () use (
            $ticket,
            $adminId,
            $description,
            $isFinal
        ) {

            /*
            |--------------------------------------------------------------------------
            | VALIDATION
            |--------------------------------------------------------------------------
            */

            if ($ticket->assigned_admin_id !== $adminId) {
                throw new \Exception(
                    'Anda tidak ditugaskan pada ticket ini.'
                );
            }

            if ($ticket->status->code === 'resolved' || $ticket->status->code === 'closed') {
                throw new \Exception(
                    'Ticket sudah selesai.'
                );
            }

            if ($ticket->status->code === 'finished') {
                throw new \Exception(
                    'Ticket sedang menunggu review.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE LOG
            |--------------------------------------------------------------------------
            */

            $log = MaintenanceLog::create([
                'ticket_id' => $ticket->id,
                'admin_id' => $adminId,
                'description' => $description,
                'is_final' => $isFinal,
            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS
            |--------------------------------------------------------------------------
            */

            if ($isFinal) {

                $status = Status::where('group', 'ticket')
                    ->where('code', 'finished')
                    ->firstOrFail();

            } else {

                $status = Status::where('group', 'ticket')
                    ->where('code', 'in_progress')
                    ->firstOrFail();
            }

            $ticket->update([
                'ticket_status_id' => $status->id
            ]);

            return $log;
        });
    }
}