<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Data Booking
        </h2>
        <p class="text-sm text-gray-400">
            Daftar booking laboratorium
        </p>
    </div>

    {{-- ACTION --}}
    <div>
        <a href="{{ route('booking.create') }}"
           class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium
                  bg-blue-500/15 text-blue-400 hover:bg-blue-500/25 transition">
            <x-icon name='plus' />
            Tambah Booking
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5 overflow-x-auto">

            <table class="w-full text-sm">
                <thead class="border-b border-gray-800">
                    <tr class="text-left text-gray-400">
                        <th class="py-3 px-4">Mahasiswa</th>
                        <th class="py-3 px-4">Lab</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Jam</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-800/60 transition">
                            <td class="py-3 px-4 text-white">
                                {{ $booking->student->display_name }}
                            </td>
                            <td class="py-3 px-4 text-gray-300">
                                {{ $booking->lab->lab_name }}
                            </td>
                            <td class="py-3 px-4 text-gray-300">
                                {{ $booking->booking_date->format('d M Y') }}
                            </td>
                            <td class="py-3 px-4 text-gray-300">
                                {{ $booking->booking_time_start }} - {{ $booking->booking_time_end }}
                            </td>
                            {{-- STATUS --}}
                            <td class="py-3 px-4">
                                @php
                                    $statusColor = match($booking->status->code ?? 'pending') {
                                        'pending' => 'bg-blue-500/15 text-blue-400',
                                        'approved' => 'bg-green-500/15 text-green-400',
                                        'rejected' => 'bg-red-500/15 text-red-400',
                                        'cancelled' => 'bg-red-500/15 text-red-400',
                                        'completed' => 'bg-gray-500/15 text-gray-400',
                                        default => 'bg-gray-500/15 text-gray-400',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium {{ $statusColor }}">
                                    {{ $booking->status->label ?? '-' }}
                                </span>
                            </td>
                            {{-- AKSI --}}
                            <td class="py-3 px-4 text-center space-x-2">
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('booking.edit', $booking->id) }}"
                                   class="px-3 py-1.5 rounded-md text-xs
                                          bg-yellow-500/15 text-yellow-400 hover:bg-yellow-500/25">
                                    Edit
                                </a>

                                <button
                                    @click.prevent="if(confirm('Yakin ingin menghapus booking ini?')) { @this.call('delete', '{{ $booking->id }}') }"
                                    class="px-3 py-1.5 rounded-md text-xs
                                           bg-red-500/15 text-red-400 hover:bg-red-500/25">
                                    Hapus
                                </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-500">
                                Belum ada data booking
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
</div>
