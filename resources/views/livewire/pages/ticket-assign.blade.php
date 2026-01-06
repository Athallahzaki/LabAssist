<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Assign Ticket
        </h2>
        <p class="text-sm text-gray-400">
            Tentukan admin penanggung jawab ticket
        </p>
    </div>

    {{-- INFO TICKET --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5 space-y-2 text-sm">
            <div>
                <span class="text-gray-400">Judul:</span>
                <span class="text-white font-medium">{{ $ticket->title }}</span>
            </div>

            <div>
                <span class="text-gray-400">Mahasiswa:</span>
                <span class="text-gray-300">{{ $ticket->student->name ?? '-' }}</span>
            </div>

            <div>
                <span class="text-gray-400">Lab:</span>
                <span class="text-gray-300">{{ $ticket->lab->lab_name ?? '-' }}</span>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <form wire:submit.prevent="assign" class="space-y-5">

                {{-- ADMIN --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Pilih Admin
                    </label>
                    <select
                        wire:model.defer="admin_id"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                               text-sm text-white
                               focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- Pilih Admin --</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}">
                                {{ $admin->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('admin_id')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ACTION --}}
                <div class="flex items-center gap-3 pt-2">
                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg text-sm font-medium
                               bg-blue-500/15 text-blue-400
                               hover:bg-blue-500/25 transition">
                        Assign
                    </button>

                    <a href="{{ route('tickets.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium
                              bg-gray-700/40 text-gray-300
                              hover:bg-gray-700/60 transition">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
