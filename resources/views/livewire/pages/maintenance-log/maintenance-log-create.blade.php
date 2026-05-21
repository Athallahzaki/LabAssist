<div class="space-y-6">

    {{-- HEADER --}}
    <div>

        <h2 class="text-2xl font-semibold text-white">
            Tambah Maintenance Log
        </h2>

        <p class="text-sm text-gray-400">
            Catat aktivitas maintenance ticket
        </p>

    </div>

    {{-- TICKET INFO --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- TICKET --}}
            <div>

                <div class="text-sm text-gray-400 mb-1">
                    Ticket
                </div>

                <div class="text-white font-medium">
                    {{ $ticket->title }}
                </div>

            </div>

            {{-- LAB --}}
            <div>

                <div class="text-sm text-gray-400 mb-1">
                    Laboratorium
                </div>

                <div class="text-white font-medium">
                    {{ $ticket->lab->lab_name }}
                </div>

            </div>

            {{-- STATUS --}}
            <div>

                <div class="text-sm text-gray-400 mb-1">
                    Status Ticket
                </div>

                <div>
                    <span class="px-2.5 py-1 rounded-md text-xs font-medium
                        bg-indigo-500/15 text-indigo-400">

                        {{ $ticket->status->label }}

                    </span>
                </div>

            </div>

            {{-- ASSIGNED --}}
            <div>

                <div class="text-sm text-gray-400 mb-1">
                    Assigned Admin
                </div>

                <div class="text-white font-medium">
                    {{ $ticket->assignedAdmin->display_name ?? '-' }}
                </div>

            </div>

        </div>
        
        {{-- DESKRIPSI KERUSAKAN --}}
        <div class="mt-4">

            <label class="block text-sm text-gray-400 mb-2">
                Deskripsi Kerusakan
            </label>

            <div class="border bg-gray-800 border-gray-700 rounded-lg p-3">

                <p class="text-sm text-gray-300 leading-relaxed">

                    {{ $ticket->description }}

                </p>    

            </div>

        </div>
        
    </div>

    {{-- FORM --}}

    <form wire:submit.prevent="save" class="bg-gray-900 border border-gray-800 rounded-xl p-5 space-y-5">

        {{-- DESCRIPTION --}}
        <div>

            <label class="block text-sm text-gray-400 mb-2">
                Deskripsi Aktivitas
            </label>

            <textarea
                wire:model.defer="description"
                rows="5"
                class="w-full bg-gray-800 border border-gray-700 rounded-lg p-3
                        text-sm text-white
                        focus:ring-1 focus:ring-blue-500 focus:outline-none"
                placeholder="Masukkan aktivitas maintenance..."></textarea>

            @error('description')
                <p class="mt-1 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- FINAL LOG --}}
        <div>

            <label class="flex items-start gap-3 cursor-pointer">

                <input
                    type="checkbox"
                    wire:model.defer="is_final"
                    class="checkbox checkbox-success checkbox-sm mt-0.5">

                <div>

                    <div class="text-sm font-medium text-white">
                        Tandai sebagai Final Maintenance Log
                    </div>

                    <div class="text-xs text-gray-400 mt-1 leading-relaxed">
                        Ticket akan berubah menjadi
                        <span class="text-green-400 font-medium">
                            Finished
                        </span>
                        dan menunggu review admin.
                    </div>

                </div>

            </label>

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

            <a href="{{ route('maintenance-logs.index') }}"
                class="px-4 py-2 rounded-lg text-sm font-medium
                        bg-gray-700/40 text-gray-300
                        hover:bg-gray-700/60 transition">

                Kembali

            </a>

        </div>

    </form>

</div>