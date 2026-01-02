<x-layouts.app :title="$title ?? 'Dashboard'">
  <div class="min-h-screen flex">

    <!-- Sidebar -->
    <livewire:components.dashboard.sidebar />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

      <main class="flex-1 p-6">
        {{ $slot }}
      </main>

      <!-- Footer -->
      <footer class="p-4 bg-gray-100">
        @Kelompok 3 - LabAssist
      </footer>

    </div>
  </div>
</x-layouts.app>