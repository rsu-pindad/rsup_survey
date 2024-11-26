<?php

use App\Livewire\Forms\AuthForm;
use function Livewire\Volt\{state, layout, title, form, action};

layout('components.layouts.guest');
title('Halaman Masuk');
form(AuthForm::class);

$masuk = function () {
    $credential = $this->form->auth();
    if ($credential) {
      return to_route('home-idle');
        // $isMultiLayanan = Auth::user()->parentKaryawanProfile()->value('layanan_id');
        // if ($isMultiLayanan) {
        //     return to_route('home-multi');
        // }
        // return to_route('home-single');
    }
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

      <div>
        <label for="hs-cover-with-gradient-form-email-1"
               class="sr-only">Email</label>
        <div class="relative">
          <input id="hs-cover-with-gradient-form-email-1"
                 wire:model="form.email"
                 type="email"
                 class="border-gray/20 bg-gray/10 text-gray placeholder:text-gray focus:border-gray/30 focus:ring-gray/30 block w-full rounded-lg py-3 pe-4 ps-11 text-sm sm:p-4 sm:ps-11"
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
        <p class="mt-2 text-sm text-red-600">
          @error('form.email')
            {{ $message }}
          @enderror
        </p>
      </div>

      <div>
        <label for="hs-cover-with-gradient-form-name-1"
               class="sr-only">Password</label>
        <div class="relative">
          <input id="hs-cover-with-gradient-form-name-1"
                 wire:model="form.password"
                 type="password"
                 class="border-gray/20 bg-gray/10 text-gray placeholder:text-gray focus:border-gray/30 focus:ring-gray/30 block w-full rounded-lg py-3 pe-4 ps-11 text-sm sm:p-4 sm:ps-11"
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
        <p class="mt-2 text-sm text-red-600">
          @error('form.password')
            {{ $message }}
          @enderror
        </p>
      </div>

      <div class="grid">
        <button type="submit"
                wire:loading.remove
                class="bg-gray/10 text-gray hover:bg-gray/20 focus:bg-gray/20 border-3 inline-flex items-center justify-center gap-x-2 rounded-lg border bg-gradient-to-l from-yellow-400 to-green-600 px-4 py-3 text-sm font-medium focus:outline-none disabled:pointer-events-none disabled:opacity-50 sm:p-4">
          Masuk
          <svg wire:loading.remove
               class="size-4 shrink-0"
               xmlns="http://www.w3.org/2000/svg"
               width="24"
               height="24"
               viewBox="0 0 24 24"
               fill="none"
               stroke="currentColor"
               stroke-width="2"
               stroke-linecap="round"
               stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
          </svg>
        </button>
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
</div>
