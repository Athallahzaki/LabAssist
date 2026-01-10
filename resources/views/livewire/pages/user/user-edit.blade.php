<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Edit User: {{ $username }}
        </h2>
        <p class="text-sm text-gray-400">
            Ubah data akun pengguna
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm">
        <div class="p-5">

            <form wire:submit.prevent="save" class="space-y-5">

                {{-- USERNAME --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Username</label>
                    <input type="text" wire:model.defer="username"
                           class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white">
                    @error('username') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Email</label>
                    <input type="email" wire:model.defer="email"
                           class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white">
                    @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- ROLE --}}
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Role</label>
                    <select wire:model.live="role_id"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white">
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_label }}</option>
                        @endforeach
                    </select>
                    @error('role_id') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- ================= ADMIN FORM ================= --}}
                @if($this->isAdminRole())
                    <div wire:key="admin-form">
                        <label class="block text-sm text-gray-400 mb-2">
                            Display Name (Admin)
                        </label>
                        <input type="text" wire:model.defer="admin_display_name"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white">
                        @error('admin_display_name')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                {{-- ================= STUDENT FORM ================= --}}
                @if($this->isStudentRole())
                    <div wire:key="student-form">
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">
                                Display Name (Student)
                            </label>
                            <input type="text" wire:model.defer="student_display_name"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-400 mb-2">NIM</label>
                            <input type="text" wire:model.defer="nim"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Class</label>
                            <input type="text" wire:model.defer="class"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white">
                        </div>
                    </div>
                @endif

                {{-- ACTION --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            class="px-4 py-2 rounded-lg text-sm font-medium
                                   bg-green-500/15 text-green-400 hover:bg-green-500/25 transition">
                        Update User
                    </button>

                    <a href="{{ route('users.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium
                              bg-gray-700/40 text-gray-300 hover:bg-gray-700/60 transition">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
