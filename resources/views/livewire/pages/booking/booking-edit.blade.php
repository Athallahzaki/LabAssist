<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Edit Booking: {{ $booking->student->display_name ?? '' }} - {{ $booking->lab->lab_name ?? '' }}
        </h2>
        <p class="text-sm text-gray-400">
            Perbarui data booking laboratorium
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5 space-y-4">

            <form wire:submit.prevent="update" class="space-y-4">

                {{-- Mahasiswa --}}
                <div>
                    <label class="text-sm text-gray-400">Mahasiswa</label>
                    <select wire:model="student_id"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->display_name }}</option>
                        @endforeach
                    </select>
                    @error('student_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Lab --}}
                <div>
                    <label class="text-sm text-gray-400">Lab</label>
                    <select wire:model="lab_id"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                        <option value="">-- Pilih Lab --</option>
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                        @endforeach
                    </select>
                    @error('lab_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Tanggal & Status --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-400">Tanggal</label>
                        <input type="date" wire:model="booking_date"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                        @error('booking_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-sm text-gray-400">Status</label>
                        <select wire:model="booking_status_id"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                            <option value="">-- Pilih Status --</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->label }}</option>
                            @endforeach
                        </select>
                        @error('booking_status_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Jam Mulai & Selesai --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-400">Jam Mulai</label>
                        <input type="time" wire:model="booking_time_start"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                        @error('booking_time_start') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-sm text-gray-400">Jam Selesai</label>
                        <input type="time" wire:model="booking_time_end"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                        @error('booking_time_end') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- ACTION --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="px-4 py-2 rounded-lg text-sm font-medium bg-green-500/15 text-green-400">
                        Update
                    </button>

                    <a href="{{ route('booking.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-700/40 text-gray-300">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
