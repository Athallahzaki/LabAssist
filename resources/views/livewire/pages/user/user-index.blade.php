<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Daftar User
        </h2>
        <p class="text-sm text-gray-400">
            Manajemen pengguna sistem
        </p>
    </div>

    {{-- ACTION --}}
    <div>
        <a href="{{ route('users.create') }}"
           class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium
                  bg-blue-500/15 text-blue-400
                  hover:bg-blue-500/25 transition">
            <x-icon name="plus" />
            Tambah User
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-gray-800">
                    <tr class="text-left text-gray-400">
                        <th class="py-3 px-4">Username</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Role</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-800/60 transition">
                            <td class="py-3 px-4 text-white">
                                {{ $user->username }}
                            </td>
                            <td class="py-3 px-4 text-gray-300">
                                {{ $user->email }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-gray-300">
                                    {{ $user->role->role_label ?? '-' }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                @php
                                    $badgeClasses = $user->is_active
                                        ? 'bg-green-500/15 text-green-400'
                                        : 'bg-red-500/15 text-red-400';
                                @endphp
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium {{ $badgeClasses }}">
                                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center space-x-2">
                                <a href="{{ route('users.edit', $user) }}"
                                   class="px-3 py-1.5 rounded-md text-xs font-medium
                                          bg-yellow-500/15 text-yellow-400
                                          hover:bg-yellow-500/25 transition">
                                    Edit
                                </a>

                                <button
                                    wire:click="toggle_active({{ $user->id }})"
                                    class="px-3 py-1.5 rounded-md text-xs font-medium
                                        bg-blue-500/15 text-blue-400
                                        hover:bg-blue-500/25 transition">
                                    {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>

                                <button
                                    @click.prevent="if(confirm('Yakin ingin menghapus user ini?')) { @this.call('delete', '{{ $user->id }}') }"
                                    class="px-3 py-1.5 rounded-md text-xs font-medium
                                           bg-red-500/15 text-red-400
                                           hover:bg-red-500/25 transition">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-500">
                                Tidak ada user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
