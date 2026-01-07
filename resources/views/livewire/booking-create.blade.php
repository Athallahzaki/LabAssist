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
        <div class="p-5 space-y-4">

            <form wire:submit.prevent="save" class="space-y-4">

                <div>
                    <label class="text-sm text-gray-400">Mahasiswa</label>
                    <select wire:model="student_id"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                        <option value="">-- pilih --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->display_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-400">Lab</label>
                    <select wire:model="lab_id"
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                        <option value="">-- pilih --</option>
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-400">Tanggal</label>
                        <input type="date" wire:model="booking_date"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                    </div>

                    <div>
                        <label class="text-sm text-gray-400">Status</label>
                        <select wire:model="booking_status_id"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-400">Jam Mulai</label>
                        <input type="time" wire:model="booking_time_start"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                    </div>

                    <div>
                        <label class="text-sm text-gray-400">Jam Selesai</label>
                        <input type="time" wire:model="booking_time_end"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <a href="{{ route('booking.index') }}"
                       class="px-4 py-2 text-sm rounded-lg bg-gray-700 text-gray-300">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-4 py-2 text-sm rounded-lg bg-blue-500/20 text-blue-400 hover:bg-blue-500/30">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
