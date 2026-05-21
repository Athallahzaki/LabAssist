<div class="space-y-6">

    {{-- Section 1 --}}
    @if(auth()->user()->isAdmin())
    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Assigned Tickets
        </h2>

        <p class="text-sm text-gray-400">
            Ticket yang sedang ditugaskan kepada anda
        </p>
    </div>

    <div class="flex gap-5 overflow-x-auto pb-2">

        @forelse($assignedTickets as $ticket)

            <div class="w-105
                        shrink-0
                        bg-gray-900
                        border border-gray-800
                        rounded-xl
                        p-5
                        shadow-sm
                        hover:border-gray-700
                        transition">

                <div class="flex flex-col h-full justify-between">

                    {{-- TOP SECTION --}}
                    <div class="space-y-5">

                        {{-- HEADER --}}
                        <div class="flex items-start justify-between gap-4">

                            <div class="space-y-2 flex-1 min-w-0">

                                {{-- TITLE --}}
                                <h3 class="text-lg font-semibold text-white
                                        wrap-break-word leading-relaxed">

                                    {{ $ticket->title }}

                                </h3>

                                {{-- LAB --}}
                                <div class="text-sm text-gray-400">

                                    {{ $ticket->lab->lab_name }}

                                </div>

                            </div>

                            {{-- STATUS --}}
                            <div class="shrink-0">

                                <span class="px-2.5 py-1 rounded-md text-xs font-medium
                                    bg-indigo-500/15 text-indigo-400">

                                    {{ $ticket->status->label }}

                                </span>

                            </div>

                        </div>

                        {{-- TELEMETRY --}}
                        <div class="grid grid-cols-2 gap-4">

                            {{-- TOTAL LOG --}}
                            <div class="bg-gray-800/60 rounded-xl p-4">

                                <div class="text-xs uppercase tracking-wide
                                            text-gray-500 mb-2">

                                    Total Log

                                </div>

                                <div class="text-2xl font-semibold text-white">

                                    {{ $ticket->maintenanceLogs->count() }}

                                </div>

                            </div>

                            {{-- LAST ACTIVITY --}}
                            <div class="bg-gray-800/60 rounded-xl p-4">

                                <div class="text-xs uppercase tracking-wide
                                            text-gray-500 mb-2">

                                    Last Activity

                                </div>

                                <div class="text-sm text-white leading-relaxed">

                                    @if($ticket->maintenanceLogs->last())

                                        {{ $ticket->maintenanceLogs->last()->created_at->diffForHumans() }}

                                    @else

                                        Belum ada log

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="mt-6">

                        <a href="{{ route('maintenance-logs.create', $ticket) }}"
                        class="inline-flex items-center justify-center
                                w-full
                                px-4 py-3
                                rounded-xl
                                text-sm font-medium
                                bg-blue-500/15 text-blue-400
                                hover:bg-blue-500/25 transition">

                            Tambah Log

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="text-gray-500 italic">
                Tidak ada ticket yang diassign
            </div>

        @endforelse

    </div>
    @endif

    {{-- Section 2 --}}
    {{--  HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Maintenance Logs
        </h2>

        <p class="text-sm text-gray-400">
            Riwayat aktivitas maintenance laboratorium
        </p>
    </div>

    {{-- MAINTENANCE LOG TABLE --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    {{-- TABLE HEADER --}}
                    <thead class="border-b border-gray-800">
                        <tr class="text-left text-gray-400">

                            <th class="py-3 px-4">
                                Ticket
                            </th>

                            <th class="py-3 px-4">
                                Lab
                            </th>

                            <th class="py-3 px-4">
                                Admin
                            </th>

                            <th class="py-3 px-4">
                                Deskripsi
                            </th>

                            <th class="py-3 px-4">
                                Type
                            </th>

                            <th class="py-3 px-4">
                                Dibuat
                            </th>

                            <th class="py-3 px-4 text-center">
                                Aksi
                            </th>

                        </tr>
                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="divide-y divide-gray-800">

                        @forelse ($logs as $log)

                            <tr class="hover:bg-gray-800/60 transition">

                                {{-- TICKET --}}
                                <td class="py-3 px-4">

                                    <div class="space-y-1">

                                        <div class="font-medium text-white">
                                            {{ $log->ticket->title ?? '-' }}
                                        </div>

                                        <div class="text-xs text-gray-500">
                                            #{{ $log->ticket->id ?? '-' }}
                                        </div>

                                    </div>

                                </td>

                                {{-- LAB --}}
                                <td class="py-3 px-4 text-gray-300">

                                    {{ $log->ticket->lab->lab_name ?? '-' }}

                                </td>

                                {{-- ADMIN --}}
                                <td class="py-3 px-4 text-gray-300">

                                    {{ $log->admin->display_name ?? '-' }}

                                </td>

                                {{-- DESCRIPTION --}}
                                <td class="py-3 px-4 text-gray-300">

                                    <div class="max-w-md truncate">
                                        {{ $log->description }}
                                    </div>

                                </td>

                                {{-- TYPE --}}
                                <td class="py-3 px-4">

                                    @if($log->is_final)

                                        <span class="px-2.5 py-1 rounded-md text-xs font-medium
                                            bg-green-500/15 text-green-400">

                                            Final Log

                                        </span>

                                    @else

                                        <span class="px-2.5 py-1 rounded-md text-xs font-medium
                                            bg-indigo-500/15 text-indigo-400">

                                            Activity

                                        </span>

                                    @endif

                                </td>

                                {{-- CREATED --}}
                                <td class="py-3 px-4 text-gray-400">

                                    <div class="space-y-1">

                                        <div>
                                            {{ $log->created_at->format('d M Y') }}
                                        </div>

                                        <div class="text-xs text-gray-500">
                                            {{ $log->created_at->diffForHumans() }}
                                        </div>

                                    </div>

                                </td>

                                {{-- ACTIONS --}}
                                <td class="py-3 px-4">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- DETAIL --}}
                                        {{-- <a href="{{ route('maintenance-logs.show', $log) }}"
                                        class="px-3 py-1.5 rounded-md text-xs font-medium
                                                bg-indigo-500/15 text-indigo-400
                                                hover:bg-indigo-500/25 transition">

                                            Detail

                                        </a> --}}

                                        {{-- EDIT --}}
                                        {{-- @if(auth()->user()->isAdmin())

                                            @if(
                                                $log->admin_id === auth()->user()->admin->id
                                            )

                                                <a href="{{ route('maintenance-logs.edit', $log) }}"
                                                class="px-3 py-1.5 rounded-md text-xs font-medium
                                                        bg-yellow-500/15 text-yellow-400
                                                        hover:bg-yellow-500/25 transition">

                                                    Edit

                                                </a>

                                            @endif

                                        @endif --}}

                                    </div>

                                </td>

                            </tr>

                        @empty

                            {{-- EMPTY STATE --}}
                            <tr>

                                <td colspan="7"
                                    class="py-8 text-center text-gray-500">

                                    Tidak ada maintenance log

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>