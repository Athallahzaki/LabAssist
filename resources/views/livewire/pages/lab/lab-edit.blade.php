<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Edit Lab: {{ $lab->lab_name }}
        </h2>
        <p class="text-sm text-gray-400">
            Perbarui informasi lab
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5 space-y-5">

            <form wire:submit.prevent="save" class="space-y-5">

                {{-- LAB NAME --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Lab Name
                    </label>
                    <input type="text" wire:model.defer="lab_name"
                           class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                  text-sm text-white
                                  focus:ring-1 focus:ring-blue-500 focus:outline-none">
                    @error('lab_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CAPACITY --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Capacity
                    </label>
                    <input type="number" wire:model.defer="capacity"
                           class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                  text-sm text-white
                                  focus:ring-1 focus:ring-blue-500 focus:outline-none">
                    @error('capacity')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">
                        Status
                    </label>
                    <select wire:model.defer="lab_status_id"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2
                                   text-sm text-white
                                   focus:ring-1 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- Pilih Status --</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->label }}</option>
                        @endforeach
                    </select>
                    @error('lab_status_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ACTION --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            class="px-4 py-2 rounded-lg text-sm font-medium
                                   bg-green-500/15 text-green-400
                                   hover:bg-green-500/25 transition">
                        Update Lab
                    </button>

                    <a href="{{ route('labs.index') }}"
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
