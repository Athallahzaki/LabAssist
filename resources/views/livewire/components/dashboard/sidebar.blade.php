<aside class="w-64 bg-slate-900 text-slate-100 flex flex-col">

    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-slate-800">
        <span class="text-xl font-bold tracking-wide text-white">
            LabAssist
        </span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1">
        <a href="/dashboard"
        class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                text-slate-300 hover:bg-slate-800 hover:text-white transition">
            <x-icon name='home' />
            <span>Dashboard</span>
        </a>

        <a href="/users"
        class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                text-slate-300 hover:bg-slate-800 hover:text-white transition">
            <x-icon name='users' />
            <span>Users</span>
        </a>

        <a href="/settings"
        class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                text-slate-300 hover:bg-slate-800 hover:text-white transition">
            <x-icon name='cog-6-tooth' />
            <span>Settings</span>
        </a>
    </nav>

    <!-- User Menu -->
    <div class="border-t border-slate-800 p-4">
        <div class="flex items-center gap-3">

            <!-- Avatar -->
            <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate">
                    {{ auth()->user()->name ?? 'User Name' }}
                </p>
                <p class="text-xs text-slate-400 truncate">
                    {{ auth()->user()->role ?? 'Administrator' }}
                </p>
            </div>

            <!-- Dropdown Trigger -->
            <button class="text-slate-400 hover:text-white">
                ⋮
            </button>
        </div>
    </div>

</aside>
