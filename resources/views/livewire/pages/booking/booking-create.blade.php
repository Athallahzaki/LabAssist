<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Tambah Booking
        </h2>
        <p class="text-sm text-gray-400">
            Buat jadwal booking laboratorium
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5 space-y-5">

            <form wire:submit.prevent="save" class="space-y-5">

                {{-- MAHASISWA --}}
                @if (auth()->user()->isAdmin())
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Mahasiswa</label>
                        <select wire:model.defer="student_id"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                text-sm text-white
                                focus:ring-1 focus:ring-blue-500 focus:outline-none">
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->display_name }}</option>
                            @endforeach
                        </select>

                        @error('student_id')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>    
                @else
                    <input type="hidden" wire:model="student_id">
                @endif

                {{-- LAB --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Lab</label>
                    <select wire:model.defer="lab_id"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                               text-sm text-white
                               focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- Pilih Lab --</option>
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                        @endforeach
                    </select>

                    @error('lab_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TANGGAL & STATUS --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Tanggal</label>
                        <input type="date" wire:model.defer="booking_date"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                   text-sm text-white
                                   focus:ring-1 focus:ring-blue-500 focus:outline-none">

                        @error('booking_date')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    @if(auth()->user()->isAdmin())
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Status Booking</label>
                            <select wire:model.defer="booking_status_id"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                    text-sm text-white
                                    focus:ring-1 focus:ring-blue-500 focus:outline-none">
                                <option value="">-- Pilih Status --</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->label }}</option>
                                @endforeach
                            </select>

                            @error('booking_status_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" wire:model="booking_status_id">
                    @endif
                </div>

                {{-- JAM MULAI & JAM SELESAI --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Jam Mulai</label>
                        <input type="time" wire:model.defer="booking_time_start"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                   text-sm text-white
                                   focus:ring-1 focus:ring-blue-500 focus:outline-none">

                        @error('booking_time_start')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Jam Selesai</label>
                        <input type="time" wire:model.defer="booking_time_end"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                   text-sm text-white
                                   focus:ring-1 focus:ring-blue-500 focus:outline-none">

                        @error('booking_time_end')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ACTION --}}
                <div class="flex items-center gap-3 pt-2">
                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg text-sm font-medium
                               bg-green-500/15 text-green-400
                               hover:bg-green-500/25 transition">
                        Simpan
                    </button>

                    <a href="{{ route('booking.index') }}"
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
