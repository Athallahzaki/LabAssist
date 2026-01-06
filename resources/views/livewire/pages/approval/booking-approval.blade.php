<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Approval Booking
        </h2>
        <p class="text-sm text-gray-400">
            Daftar booking yang menunggu persetujuan admin
        </p>
    </div>

    {{-- ALERT --}}
    @if (session()->has('success'))
        <div class="bg-green-500/15 text-green-400 border border-green-500/20 rounded-lg px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-gray-800">
                        <tr class="text-left text-gray-400">
                            <th class="py-3 px-4">Mahasiswa</th>
                            <th class="py-3 px-4">Lab</th>
                            <th class="py-3 px-4">Tanggal</th>
                            <th class="py-3 px-4">Jam</th>
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

                                <td class="py-3 px-4 text-center space-x-2">
                                    <button
                                        wire:click="approve({{ $booking->id }})"
                                        class="px-3 py-1.5 rounded-md text-xs font-medium
                                            bg-green-500/15 text-green-400
                                            hover:bg-green-500/25 transition">
                                        Approve
                                    </button>

                                    <button
                                        wire:click="reject({{ $booking->id }})"
                                        class="px-3 py-1.5 rounded-md text-xs font-medium
                                            bg-red-500/15 text-red-400
                                            hover:bg-red-500/25 transition">
                                        Reject
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500">
                                    Tidak ada booking pending
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MESSAGE --}}
            <div class="mt-4">
                <label class="block text-sm text-gray-400 mb-2">
                    Pesan (opsional)
                </label>
                <textarea
                    wire:model.defer="message"
                    rows="3"
                    placeholder="Tambahkan catatan approval..."
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg p-3 text-sm text-white
                           focus:ring-1 focus:ring-blue-500 focus:outline-none"></textarea>
            </div>

        </div>
    </div>
</div>
