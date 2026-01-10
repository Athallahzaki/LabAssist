<aside class="w-64 bg-slate-900 text-slate-100 flex flex-col">

    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-slate-800">
        <span class="text-xl font-bold tracking-wide text-white">
            LabAssist
        </span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1">

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                  {{ request()->routeIs('dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
            <x-icon name='home' />
            <span>Dashboard</span>
        </a>

        <a href="{{ route('labs.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                    {{ request()->routeIs('labs.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
            <x-icon name='building-office' />
            <span>Labs</span>
        </a>

        <a href="{{ route('booking.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                  {{ request()->routeIs('booking.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
            <x-icon name='calendar' />
            <span>Bookings</span>
        </a>

        <a href="{{ route('tickets.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                  {{ request()->routeIs('tickets.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
            <x-icon name='ticket' />
            <span>Tickets</span>
        </a>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('approval.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                      {{ request()->routeIs('approval.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
                <x-icon name='check-circle' />
                <span>Approvals</span>
            </a>
            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium
                      {{ request()->routeIs('users.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
                <x-icon name='users' />
                <span>Users</span>
            </a>
        @endif

    </nav>

    <!-- User Menu -->
    <div class="border-t border-slate-800 p-4" x-data="{ open: false }">
        <div class="relative flex items-center gap-3">

            <!-- Avatar -->
            <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold">
                {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 1)) }}
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate">
                    {{ auth()->user()->username ?? 'User Name' }}
                </p>
                <p class="text-xs text-slate-400 truncate">
                    {{ auth()->user()->role->role_label ?? 'Administrator' }}
                </p>
            </div>

            <!-- Dropdown Trigger -->
            <button 
                @click="open = !open"
                class="text-slate-400 hover:text-white focus:outline-none">
                <x-icon name='ellipsis-vertical' />
            </button>

            <!-- Dropdown -->
            <div
                x-show="open"
                @click.outside="open = false"
                x-transition
                class="absolute right-0 bottom-12 w-40 bg-slate-800 border border-slate-700 rounded-md shadow-lg overflow-hidden z-50"
            >
                <button
                    @click="
                        const theme = document.documentElement.getAttribute('data-theme') === 'dark'
                            ? 'light'
                            : 'dark';
                        document.documentElement.setAttribute('data-theme', theme);
                        localStorage.setItem('theme', theme);
                    "
                    class="w-full flex items-center gap-2 px-4 py-2 text-sm
                        hover:bg-slate-700 transition"
                >
                    <x-icon name="moon" class="h-4 w-4" />
                    <span>Toggle Theme</span>
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full flex items-center gap-2 text-left px-4 py-2 text-sm
                            text-red-400 hover:bg-slate-700 hover:text-red-300 transition"
                    >
                        <x-icon name="arrow-right-start-on-rectangle" class="h-4 w-4" />
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
