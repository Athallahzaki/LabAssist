<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Daftar Ticket
        </h2>
        <p class="text-sm text-gray-400">
            Manajemen ticket laporan mahasiswa
        </p>
    </div>

    {{-- ACTION --}}
    <div>
        <a href="{{ route('tickets.create') }}"
           class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium
                  bg-blue-500/15 text-blue-400
                  hover:bg-blue-500/25 transition">
            <x-icon name='plus' />
            Tambah Ticket
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-gray-800">
                        <tr class="text-left text-gray-400">
                            <th class="py-3 px-4">Judul</th>
                            <th class="py-3 px-4">Mahasiswa</th>
                            <th class="py-3 px-4">Lab</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Ditangani Oleh</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-800">
                        @forelse ($tickets as $ticket)
                            <tr class="hover:bg-gray-800/60 transition">
                                <td class="py-3 px-4 text-white">
                                    {{ $ticket->title }}
                                </td>

                                <td class="py-3 px-4 text-gray-300">
                                    {{ $ticket->student->display_name ?? '-' }}
                                </td>

                                <td class="py-3 px-4 text-gray-300">
                                    {{ $ticket->lab->lab_name ?? '-' }}
                                </td>

                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 rounded-md text-xs font-medium
                                        bg-indigo-500/15 text-indigo-400">
                                        {{ $ticket->status->label ?? '-' }}
                                    </span>
                                </td>

                                <td class="py-3 px-4 text-gray-300">
                                    @if ($ticket->assignedAdmin)
                                        {{ $ticket->assignedAdmin->display_name }}
                                    @else
                                        <span class="italic text-gray-500">
                                            Belum ditangani
                                        </span>
                                    @endif
                                </td>


                                <td class="py-3 px-4 text-center space-x-2">
                                    <a href="{{ route('tickets.show', $ticket) }}"
                                    class="px-3 py-1.5 rounded-md text-xs font-medium
                                            bg-indigo-500/15 text-indigo-400
                                            hover:bg-indigo-500/25 transition">
                                        Detail
                                    </a>
                                    
                                    @if(auth()->user()->isAdmin() && !$ticket->isDone())
                                    <a href="{{ route('tickets.edit', $ticket) }}"
                                       class="px-3 py-1.5 rounded-md text-xs font-medium
                                              bg-yellow-500/15 text-yellow-400
                                              hover:bg-yellow-500/25 transition">
                                        Edit
                                    </a>

                                    <a href="{{ route('tickets.assign', $ticket) }}"
                                       class="px-3 py-1.5 rounded-md text-xs font-medium
                                              bg-blue-500/15 text-blue-400
                                              hover:bg-blue-500/25 transition">
                                        Assign
                                    </a>
                                    
                                    <button
                                        @click.prevent="if(confirm('Yakin ingin menghapus ticket ini?')) { @this.call('delete', '{{ $ticket->id }}') }"
                                        class="px-3 py-1.5 rounded-md text-xs font-medium
                                               bg-red-500/15 text-red-400
                                               hover:bg-red-500/25 transition">
                                        Hapus
                                    </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500">
                                    Tidak ada ticket
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
