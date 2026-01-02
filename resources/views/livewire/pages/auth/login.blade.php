<div class="space-y-4">
  <input wire:model.defer="email" type="email" class="input input-bordered w-full" placeholder="Email" />
  <input wire:model.defer="password" type="password" class="input input-bordered w-full" placeholder="Password" />

  <button wire:click="login" class="btn btn-primary w-full mt-2">
    Login
  </button>

  <p class="text-sm text-center">
    Belum punya akun?
    <button class="link" wire:click="switchMode">Daftar</button>
  </p>
</div>
