<div class="space-y-4">
  <input wire:model.defer="username" class="input input-bordered w-full" placeholder="Username" />
  <input wire:model.defer="reg_email" type="email" class="input input-bordered w-full" placeholder="Email" />
  <input wire:model.defer="reg_password" type="password" class="input input-bordered w-full" placeholder="Password" />
  <input wire:model.defer="nim" class="input input-bordered w-full" placeholder="NIM" />
  <input wire:model.defer="class" class="input input-bordered w-full" placeholder="Kelas" />

  <button wire:click="register" class="btn btn-primary w-full mt-2">
    Daftar
  </button>

  <p class="text-sm text-center">
    Sudah punya akun?
    <button class="link" wire:click="switchMode">Login</button>
  </p>
</div>
