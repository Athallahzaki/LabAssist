<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Review Maintenance
        </h2>

        <p class="text-sm text-gray-400">
            Review hasil maintenance sebelum ticket ditutup
        </p>
    </div>

    {{-- TICKET INFO --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5 space-y-5">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- TICKET --}}
                <div>
                    <div class="text-sm text-gray-400 mb-1">
                        Judul Ticket
                    </div>

                    <div class="text-white font-medium">
                        {{ $ticket->title }}
                    </div>
                </div>

                {{-- STATUS --}}
                <div>
                    <div class="text-sm text-gray-400 mb-1">
                        Status Ticket
                    </div>

                    <span class="px-2.5 py-1 rounded-md text-xs font-medium
                        bg-indigo-500/15 text-indigo-400">
                        {{ $ticket->status->label }}
                    </span>
                </div>

                {{-- MAHASISWA --}}
                <div>
                    <div class="text-sm text-gray-400 mb-1">
                        Mahasiswa
                    </div>

                    <div class="text-white font-medium">
                        {{ $ticket->student->display_name }}
                    </div>
                </div>

                {{-- LAB --}}
                <div>
                    <div class="text-sm text-gray-400 mb-1">
                        Laboratorium
                    </div>

                    <div class="text-white font-medium">
                        {{ $ticket->lab->lab_name }}
                    </div>
                </div>

                {{-- ASSIGNED ADMIN --}}
                <div>
                    <div class="text-sm text-gray-400 mb-1">
                        Assigned Admin
                    </div>

                    <div class="text-white font-medium">
                        {{ $ticket->assignedAdmin?->display_name ?? '-' }}
                    </div>
                </div>

            </div>

            {{-- DESKRIPSI KERUSAKAN --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">
                    Deskripsi Kerusakan
                </label>

                <div class="border bg-gray-800 border-gray-700 rounded-lg p-3">
                    <p class="text-sm text-gray-300 leading-relaxed">
                        {{ $ticket->description }}
                    </p>
                </div>
            </div>

        </div>
    </div>

    {{-- FINAL LOG HIGHLIGHT --}}
    @if($finalLog)
    <div class="bg-green-500/5 border border-green-500/20 rounded-xl shadow-sm">
        <div class="p-5">

            <div class="flex items-center justify-between mb-4">

                <h3 class="text-lg font-semibold text-green-400">
                    Final Maintenance Log
                </h3>

                <span class="px-2.5 py-1 rounded-md text-xs font-medium
                    bg-green-500/15 text-green-400">
                    Final Log
                </span>

            </div>

            <div class="text-sm text-gray-300 whitespace-pre-line leading-relaxed">
                {{ $finalLog->description }}
            </div>

            <div class="mt-4 text-xs text-gray-500">
                Oleh {{ $finalLog->admin->display_name ?? '-' }}
                •
                {{ $finalLog->created_at->format('d M Y H:i') }}
            </div>

        </div>
    </div>
    @endif

    {{-- TIMELINE --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <div class="mb-5">
                <h3 class="text-lg font-semibold text-white">
                    Timeline Maintenance
                </h3>

                <p class="text-sm text-gray-400">
                    Riwayat aktivitas maintenance yang dilakukan
                </p>
            </div>

            <div class="space-y-4">

                @forelse($ticket->maintenanceLogs->sortBy('created_at') as $log)

                    <div class="relative border border-gray-800 rounded-xl p-4">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex-1">

                                <div class="flex flex-wrap items-center gap-2 mb-2">

                                    <span class="text-sm font-medium text-white">
                                        {{ $log->admin->display_name }}
                                    </span>

                                    @if($log->is_final)
                                        <span class="px-2 py-1 rounded-md text-xs font-medium
                                            bg-green-500/15 text-green-400">
                                            Final Log
                                        </span>
                                    @endif

                                </div>

                                <p class="text-sm text-gray-300 whitespace-pre-line">
                                    {{ $log->description }}
                                </p>

                            </div>

                            <div class="text-xs text-gray-500 whitespace-nowrap">
                                {{ $log->created_at->format('d M Y H:i') }}
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-6 text-gray-500">
                        Tidak ada maintenance log.
                    </div>

                @endforelse

            </div>

        </div>
    </div>

    {{-- REVIEW ACTION --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <h3 class="text-lg font-semibold text-white">
                Keputusan Review
            </h3>

            <p class="text-sm text-gray-400 mt-1">
                Tentukan apakah maintenance telah selesai dilakukan dan laboratorium siap digunakan kembali.
            </p>

            <div class="flex flex-wrap gap-3 mt-6">

                {{-- APPROVE --}}
                <button
                    wire:click="approve"
                    wire:confirm="Yakin ingin menyetujui maintenance ini?"
                    class="px-4 py-2 rounded-lg text-sm font-medium
                        bg-green-500/15 text-green-400
                        hover:bg-green-500/25 transition">

                    Approve Maintenance

                </button>

                {{-- REJECT --}}
                <button
                    wire:click="reject"
                    wire:confirm="Yakin ingin mengembalikan ticket ke proses maintenance?"
                    class="px-4 py-2 rounded-lg text-sm font-medium
                        bg-red-500/15 text-red-400
                        hover:bg-red-500/25 transition">

                    Reject Maintenance

                </button>

                {{-- BACK --}}
                <a
                    href="{{ route('maintenance-logs.index') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium
                        bg-gray-700/40 text-gray-300
                        hover:bg-gray-700/60 transition">

                    Kembali

                </a>

            </div>

        </div>
    </div>

</div>