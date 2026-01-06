<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Edit Ticket
        </h2>
        <p class="text-sm text-gray-400">
            Perbarui informasi ticket mahasiswa
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5 space-y-5">

            <form wire:submit.prevent="save" class="space-y-5">

                {{-- JUDUL --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Judul Ticket
                    </label>
                    <input
                        type="text"
                        wire:model.defer="ticket.title"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                               text-sm text-white
                               focus:ring-1 focus:ring-blue-500 focus:outline-none">

                    @error('ticket.title')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Deskripsi
                    </label>
                    <textarea
                        wire:model.defer="ticket.description"
                        rows="4"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg p-3
                               text-sm text-white
                               focus:ring-1 focus:ring-blue-500 focus:outline-none"></textarea>

                    @error('ticket.description')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Status Ticket
                    </label>
                    <select
                        wire:model.defer="ticket.ticket_status_id"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                               text-sm text-white
                               focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('ticket.ticket_status_id')
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
                               bg-green-500/15 text-green-400
                               hover:bg-green-500/25 transition">
                        Update
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
