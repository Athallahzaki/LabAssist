<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Riwayat Approval
        </h2>
        <p class="text-sm text-gray-400">
            Daftar booking yang telah diproses oleh admin
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-gray-800">
                        <tr class="text-left text-gray-400">
                            <th class="py-3 px-4">Mahasiswa</th>
                            <th class="py-3 px-4">Lab</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Admin</th>
                            <th class="py-3 px-4">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-800">
                        @forelse ($approvals as $approval)
                            <tr class="hover:bg-gray-800/60 transition">
                                <td class="py-3 px-4 text-white">
                                    {{ $approval->booking->student->display_name }}
                                </td>

                                <td class="py-3 px-4 text-gray-300">
                                    {{ $approval->booking->lab->lab_name }}
                                </td>

                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium
                                        @if($approval->status->code === 'approved')
                                            bg-green-500/15 text-green-400
                                        @elseif($approval->status->code === 'rejected')
                                            bg-red-500/15 text-red-400
                                        @else
                                            bg-yellow-500/15 text-yellow-400
                                        @endif
                                    ">
                                        {{ ucfirst($approval->status->code) }}
                                    </span>
                                </td>

                                <td class="py-3 px-4 text-gray-300">
                                    {{ $approval->admin->display_name }}
                                </td>

                                <td class="py-3 px-4 text-gray-400">
                                    {{ $approval->approved_at->format('d M Y, H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500">
                                    Belum ada riwayat approval
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
