@aware([
    'logoMain' => '',
    'namaUnit' => '',
    'alamatUnit' => '',
])
<nav class="@if (Route::currentRouteName() == 'survey-pasien') hidden sm:hidden md:hidden lg:block xl:block @endif shadow">
  <div class="mx-auto max-w-3xl px-3 sm:px-5 lg:px-6">
    <div class="flex items-center justify-around py-4">
      <!-- Logo -->
      <div class="flex items-center">
        <img src="{{ Storage::disk('public')->url($logoMain ?? 'photos/logopmu.png') }}"
             alt="Logo"
             class="h-auto w-32 object-cover">
      </div>
      <!-- Alamat -->
      <div class="hidden md:block">
        <span class="text-center font-mono text-sm text-gray-600 hover:hidden">{{ $alamatUnit ?? '' }}</span>
      </div>

      <!-- Dropdown -->
      <div class="hs-dropdown relative inline-flex w-32 place-content-end [--placement:bottom-right]">
        <button id="hs-dropdown-account"
                type="button"
                class="size-[38px] inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                aria-haspopup="menu"
                aria-expanded="false"
                aria-label="Dropdown">
          <img class="size-[38px] shrink-0 rounded-full"
               src="https://via.placeholder.com/50"
               alt="Avatar">
        </button>

        <div class="hs-dropdown-menu duration min-w-38 mt-2 hidden rounded-lg bg-white opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100"
             role="menu"
             aria-orientation="vertical"
             aria-labelledby="hs-dropdown-account">
          <div class="rounded-t-lg bg-gray-100 px-5 py-3">
            <p class="text-sm text-gray-500">Masuk Sebagai</p>
            <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
          </div>
          <div class="space-y-0.5 p-1.5">
            <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
               href="#">
              <i data-lucide="user-pen"
                 class="size-4 shrink-0"></i>
              Profil
            </a>
            <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
               href="{{ route('logout') }}">
              <i data-lucide="log-out"
                 class="size-4 shrink-0"></i>
              Keluar
            </a>
          </div>
        </div>
      </div>
      <!-- End Dropdown -->

    </div>
  </div>
</nav>
