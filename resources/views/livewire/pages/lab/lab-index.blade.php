<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Daftar Lab
        </h2>
        <p class="text-sm text-gray-400">
            Manajemen lab yang tersedia
        </p>
    </div>

    {{-- ACTION --}}
    @if(auth()->user()->isAdmin())
    <div>
        <a href="{{ route('labs.create') }}"
           class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium
                  bg-blue-500/15 text-blue-400
                  hover:bg-blue-500/25 transition">
            <x-icon name='plus' />
            Tambah Lab
        </a>
    </div>
    @endif

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-gray-800">
                    <tr class="text-left text-gray-400">
                        <th class="py-3 px-4">Nama Lab</th>
                        <th class="py-3 px-4">Kapasitas</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @forelse($labs as $lab)
                        <tr class="hover:bg-gray-800/60 transition">
                            <td class="py-3 px-4 text-white">
                                {{ $lab->lab_name }}
                            </td>
                            <td class="py-3 px-4 text-gray-300">
                                {{ $lab->capacity }} Orang
                            </td>
                            <td class="py-3 px-4">
                                @php
                                    // Tentukan warna badge berdasarkan status
                                    switch ($lab->status->label ?? '') {
                                        case 'Tersedia':
                                            $badgeClasses = 'bg-green-500/15 text-green-400';
                                            break;
                                        case 'Dipakai':
                                        case 'Perawatan':
                                            $badgeClasses = 'bg-purple-500/15 text-purple-400';
                                            break;
                                        case 'Tidak Aktif':
                                            $badgeClasses = 'bg-red-500/15 text-red-400';
                                            break;
                                        default:
                                            $badgeClasses = 'bg-gray-500/15 text-gray-400';
                                    }
                                @endphp
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium {{ $badgeClasses }}">
                                    {{ $lab->status->label ?? 'Unknown' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center space-x-2">
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('labs.edit', $lab) }}"
                                   class="px-3 py-1.5 rounded-md text-xs font-medium
                                          bg-yellow-500/15 text-yellow-400
                                          hover:bg-yellow-500/25 transition">
                                    Edit
                                </a>

                                <button 
                                @click.prevent="if(confirm('Yakin ingin menghapus lab ini?')) { @this.call('delete', '{{ $lab->id }}') }"
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
                            <td colspan="4" class="py-6 text-center text-gray-500">
                                Tidak ada lab.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
