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

        {{-- LEFT CARD: Avatar + Welcome + Logout --}}
        <div
            class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm p-6
                   flex items-center justify-between"
        >
            {{-- LEFT CONTENT --}}
            <div class="flex items-center gap-4">

                {{-- Avatar --}}
                <div
                    class="h-12 w-12 rounded-full bg-indigo-600
                           flex items-center justify-center
                           text-white font-semibold text-lg"
                >
                    {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 1)) }}
                </div>

                {{-- Welcome Text --}}
                <div>
                    <h3 class="text-xl font-bold text-white">
                        Selamat Datang!
                    </h3>
                    <p class="text-gray-400 text-sm mt-1">
                        {{ auth()->user()->username ?? 'User' }}
                    </p>
                </div>

            </div>

            {{-- LOGOUT BUTTON --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="inline-flex items-center gap-2
                           px-4 py-2 rounded-lg
                           text-sm font-medium
                           text-red-400 border border-red-500/30
                           hover:bg-red-500/10 transition"
                >
                    <x-icon name="arrow-right-start-on-rectangle" class="h-4 w-4" />
                    Logout
                </button>
            </form>
        </div>

        {{-- RIGHT CARD: LabAssist Info --}}
        <div
            class="bg-gray-900 border border-gray-800 rounded-xl shadow-sm p-6
                   flex flex-col justify-center items-end text-right"
        >
            <h3 class="text-lg font-semibold text-white">
                LabAssist
            </h3>
            <p class="text-gray-400 text-sm mt-1">
                v1.0.0
            </p>
            <a
                href="https://github.com/Athallahzaki/LabAssist"
                target="_blank"
                class="text-blue-400 hover:text-blue-500 text-sm mt-1"
            >
                View on GitHub
            </a>
        </div>

    </div>

</div>
