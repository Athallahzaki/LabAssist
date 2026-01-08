<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Tambah Ticket
        </h2>
        <p class="text-sm text-gray-400">
            Buat ticket laporan baru
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <form wire:submit.prevent="save" class="space-y-5">

                {{-- JUDUL --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Judul Ticket
                    </label>
                    <input
                        type="text"
                        wire:model.defer="title"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                               text-sm text-white
                               focus:ring-1 focus:ring-blue-500 focus:outline-none">

                    @error('title')
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
                        wire:model.defer="description"
                        rows="4"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg p-3
                               text-sm text-white
                               focus:ring-1 focus:ring-blue-500 focus:outline-none"></textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- MAHASISWA --}}
                @if (auth()->user()->isAdmin())
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">
                            Mahasiswa
                        </label>
                        <select
                            wire:model.defer="student_id"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                text-sm text-white
                                focus:ring-1 focus:ring-blue-500 focus:outline-none">
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">
                                    {{ $student->display_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('student_id')
                            <p class="mt-1 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                @else
                    <input type="hidden" wire:model="student_id">
                @endif

                {{-- LAB --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Lab
                    </label>
                    <select
                        wire:model.defer="lab_id"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                               text-sm text-white
                               focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- Pilih Lab --</option>
                        @foreach($labs as $lab)
                            <option value="{{ $lab->id }}">
                                {{ $lab->lab_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('lab_id')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- STATUS --}}
                @if(auth()->user()->isAdmin())
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">
                            Status Ticket
                        </label>
                        <select
                            wire:model.defer="ticket_status_id"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                text-sm text-white
                                focus:ring-1 focus:ring-blue-500 focus:outline-none">
                            <option value="">-- Pilih Status --</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">
                                    {{ $status->label }}
                                </option>
                            @endforeach
                        </select>

                        @error('ticket_status_id')
                            <p class="mt-1 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                @else
                    <input type="hidden" wire:model="ticket_status_id">
                @endif

                {{-- ACTION --}}
                <div class="flex items-center gap-3 pt-2">
                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg text-sm font-medium
                               bg-green-500/15 text-green-400
                               hover:bg-green-500/25 transition">
                        Simpan
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
