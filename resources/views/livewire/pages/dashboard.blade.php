<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Dashboard
        </h2>
        <p class="text-sm text-gray-400">
            Ringkasan akun Anda
        </p>
    </div>

    {{-- CARDS CONTAINER --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- LEFT CARD: Welcome + Logout di kanan --}}
        <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm p-6 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-white">Selamat Datang!</h3>
                <p class="text-gray-400 mt-1">{{ auth()->user()->username ?? 'User' }}</p>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 btn btn-outline btn-error rounded-lg transition">
                        <x-icon name="arrow-right-start-on-rectangle" class="h-4 w-4" />
                        Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- RIGHT CARD: LabAssist Info --}}
        <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm p-6 flex flex-col justify-center items-end text-right">
            <h3 class="text-lg font-semibold text-white">LabAssist</h3>
            <p class="text-gray-400 text-sm mt-1">v1.0.0</p>
            <a href="https://github.com/Athallahzaki/LabAssist" target="_blank"
                class="text-blue-400 hover:text-blue-500 text-sm mt-1">
                View on GitHub
            </a>
        </div>

    </div>

</div>