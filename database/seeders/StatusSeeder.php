<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [

            // ================= BOOKING =================
            ['group' => 'booking', 'code' => 'pending',   'label' => 'Menunggu Persetujuan'],
            ['group' => 'booking', 'code' => 'approved',  'label' => 'Disetujui'],
            ['group' => 'booking', 'code' => 'rejected',  'label' => 'Ditolak'],
            ['group' => 'booking', 'code' => 'cancelled', 'label' => 'Dibatalkan'],
            ['group' => 'booking', 'code' => 'completed', 'label' => 'Selesai'],

            // ================= APPROVAL =================
            ['group' => 'approval', 'code' => 'waiting',  'label' => 'Menunggu'],
            ['group' => 'approval', 'code' => 'approved', 'label' => 'Disetujui'],
            ['group' => 'approval', 'code' => 'rejected', 'label' => 'Ditolak'],

            // ================= LAB =================
            ['group' => 'lab', 'code' => 'available',   'label' => 'Tersedia'],
            ['group' => 'lab', 'code' => 'booked',      'label' => 'Dipakai'],
            ['group' => 'lab', 'code' => 'maintenance', 'label' => 'Perawatan'],
            ['group' => 'lab', 'code' => 'inactive',    'label' => 'Tidak Aktif'],

            // ================= TICKET =================
            ['group' => 'ticket', 'code' => 'open',        'label' => 'Dibuka'],
            ['group' => 'ticket', 'code' => 'in_progress', 'label' => 'Sedang Ditangani'],
            ['group' => 'ticket', 'code' => 'resolved',    'label' => 'Terselesaikan'],
            ['group' => 'ticket', 'code' => 'closed',      'label' => 'Ditutup'],

            // ================= TICKET PRIORITY =================
            ['group' => 'ticket_priority', 'code' => 'low',    'label' => 'Rendah'],
            ['group' => 'ticket_priority', 'code' => 'medium', 'label' => 'Sedang'],
            ['group' => 'ticket_priority', 'code' => 'high',   'label' => 'Tinggi'],
            ['group' => 'ticket_priority', 'code' => 'urgent', 'label' => 'Mendesak'],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(
                [
                    'group' => $status['group'],
                    'code'  => $status['code'],
                ],
                [
                    'label' => $status['label'],
                ]
            );
        }
    }
}
