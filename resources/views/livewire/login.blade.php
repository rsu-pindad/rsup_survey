<?php

use App\Livewire\Forms\AuthForm;
use function Livewire\Volt\{state, layout, title, form, action, mount};

layout('components.layouts.guest');
state(['credential']);
mount(function () {
    $this->credential = '';
});
title('Halaman Masuk');
form(AuthForm::class);

$masuk = function () {
    $this->credential = $this->form->auth();
    if ($this->credential) {
        return to_route('home-idle');
        // $isMultiLayanan = Auth::user()->parentKaryawanProfile()->value('layanan_id');
        // if ($isMultiLayanan) {
        //     return to_route('home-multi');
        // }
        // return to_route('home-single');
    }
    return $this->credential;
};
?>

<div class="px-4 py-8 text-center sm:px-6 lg:px-8">

  <h2 class="text-gray mt-1 text-3xl font-bold sm:mt-3 sm:text-5xl">
    <span class="bg-gradient-to-tr from-green-600 to-yellow-400 bg-clip-text text-transparent">
      PT Pindad Medika Utama
    </span>
  </h2>

  <form wire:submit="masuk">
    <div class="mt-8 space-y-4">

      <div class="group">
        <label for="hs-cover-with-gradient-form-email-1"
               class="sr-only">Email</label>
        <div class="relative">
          <input id="hs-cover-with-gradient-form-email-1"
                 wire:model="form.email"
                 type="email"
                 class="border-gray/20 bg-gray/10 text-gray placeholder:text-gray focus:border-gray/30 focus:ring-gray/30 block w-full rounded-full py-3 pe-4 ps-11 text-lg sm:p-4 sm:ps-11"
                 placeholder="Masukan email">
          <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-4">
            <svg class="size-4 shrink-0 text-gray-400"
                 xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">
              <rect width="20"
                    height="16"
                    x="2"
                    y="4"
                    rx="2" />
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
            </svg>
          </div>
        </div>
        @error('form.email')
          <p class="text-md mt-2 font-semibold text-red-600">
            {{ $message }}
          </p>
        @enderror
      </div>

      <div>
        <label for="hs-cover-with-gradient-form-name-1"
               class="sr-only">Password</label>
        <div class="relative">
          <input id="hs-cover-with-gradient-form-name-1"
                 wire:model="form.password"
                 type="password"
                 class="border-gray/20 bg-gray/10 text-gray placeholder:text-gray focus:border-gray/30 focus:ring-gray/30 block w-full rounded-full py-3 pe-4 ps-11 text-lg sm:p-4 sm:ps-11"
                 placeholder="Masukan password">
          <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-4">
            <svg class="size-4 shrink-0 text-gray-400"
                 xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="lucide lucide-key-round">
              <path
                    d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z" />
              <circle cx="16.5"
                      cy="7.5"
                      r=".5"
                      fill="currentColor" />
            </svg>
          </div>
        </div>
        @error('form.password')
          <p class="text-md mt-2 font-semibold text-red-600">
            {{ $message }}
          </p>
        @enderror
      </div>

      <div class="grid">
        <div class="group"
             wire:loading.remove>
          <button type="submit"
                  class="bg-gray/10 hover:bg-gray/20 focus:bg-gray/20 border-3 inline-flex items-center justify-center gap-x-4 rounded-full border bg-gradient-to-l from-yellow-400 to-green-600 px-6 py-3 text-xl font-semibold uppercase text-neutral-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
            Masuk
            <svg class="size-5 shrink-0"
                 xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="lucide lucide-key-round">
              <path
                    d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z" />
              <circle cx="16.5"
                      cy="7.5"
                      r=".5"
                      fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>

      <div class="grid"
           wire:loading
           wire:loading.target="masuk">
        <div class="size-6 inline-block animate-spin rounded-full border-[3px] border-current border-t-transparent text-green-600 dark:text-green-500"
             role="status"
             aria-label="loading">
          <span class="sr-only">Loading...</span>
        </div>
      </div>

    </div>
  </form>

  @if ($this->credential === false)
    <!-- Toast -->
    <div class="absolute bottom-5 start-1/2 -translate-x-1/2">
      <div class="max-w-xs rounded-xl bg-red-500 text-sm text-white shadow-lg"
           role="alert"
           tabindex="-1"
           aria-labelledby="hs-toast-solid-color-red-label">
        <div id="hs-toast-solid-color-red-label"
             class="flex p-4">
          Email atau password salah

          <div class="ms-auto">
            <button type="button"
                    class="size-5 inline-flex shrink-0 items-center justify-center rounded-lg text-white opacity-50 hover:text-white hover:opacity-100 focus:opacity-100 focus:outline-none"
                    aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="size-4 shrink-0"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Toast -->
  @endif

</div>
