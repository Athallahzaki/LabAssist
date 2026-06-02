<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Detail Ticket
        </h2>

        <p class="text-sm text-gray-400">
            Informasi ticket dan progres maintenance
        </p>
    </div>

    {{-- TICKET INFO --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5 space-y-5">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-gray-400 mb-1">
                        Judul Ticket
                    </p>

                    <p class="text-white font-medium">
                        {{ $ticket->title }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400 mb-1">
                        Mahasiswa
                    </p>

                    <p class="text-white font-medium">
                        {{ $ticket->student->display_name ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400 mb-1">
                        Laboratorium
                    </p>

                    <p class="text-white font-medium">
                        {{ $ticket->lab->lab_name ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400 mb-1">
                        Status Ticket
                    </p>

                    <span class="px-2.5 py-1 rounded-md text-xs font-medium
                        bg-indigo-500/15 text-indigo-400">
                        {{ $ticket->status->label }}
                    </span>
                </div>

                <div>
                    <p class="text-sm text-gray-400 mb-1">
                        Assigned Admin
                    </p>

                    <p class="text-white font-medium">
                        {{ $ticket->assignedAdmin->display_name ?? 'Belum Ditugaskan' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400 mb-1">
                        Dibuat Pada
                    </p>

                    <p class="text-white font-medium">
                        {{ $ticket->created_at->format('d M Y H:i') }}
                    </p>
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

    {{-- TIMELINE --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <h3 class="text-white font-medium mb-5">
                Timeline Maintenance
            </h3>

            @forelse($ticket->maintenanceLogs->sortBy('created_at') as $log)

                <div class="flex gap-4">

                    {{-- TIMELINE --}}
                    <div class="flex flex-col items-center">

                        <div class="
                            w-3 h-3 rounded-full
                            {{ $log->is_final
                                ? 'bg-green-400'
                                : 'bg-blue-400'
                            }}">
                        </div>

                        @if(!$loop->last)
                            <div class="w-px flex-1 bg-gray-700 mt-2"></div>
                        @endif

                    </div>

                    {{-- CONTENT --}}
                    <div class="pb-8 flex-1">

                        <div class="flex items-center gap-2 mb-2">

                            <span class="text-white font-medium">
                                {{ $log->admin->display_name }}
                            </span>

                            @if($log->is_final)
                                <span
                                    class="px-2 py-0.5 rounded text-xs
                                           bg-green-500/15 text-green-400">
                                    Final Log
                                </span>
                            @endif

                        </div>

                        <p class="text-sm text-gray-300 whitespace-pre-line">
                            {{ $log->description }}
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            {{ $log->created_at->format('d M Y H:i') }}
                        </p>

                    </div>

                </div>

            @empty

                <div class="text-center py-10 text-gray-500">
                    Belum ada maintenance log.
                </div>

            @endforelse

        </div>
    </div>

    {{-- ACTION --}}
    <div class="flex items-center gap-3">

        <a href="{{ route('tickets.index') }}"
           class="px-4 py-2 rounded-lg text-sm font-medium
                  bg-gray-700/40 text-gray-300
                  hover:bg-gray-700/60 transition">
            Kembali
        </a>

    </div>

</div>