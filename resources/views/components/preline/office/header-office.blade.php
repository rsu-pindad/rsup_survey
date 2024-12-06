<header
        class="sticky inset-x-0 top-0 z-[48] flex w-full flex-wrap border-b bg-white py-2.5 text-sm md:flex-nowrap md:justify-start lg:ps-[260px]">
  <nav class="mx-auto flex w-full basis-full items-center px-4 sm:px-6">
    <div class="me-5 lg:me-0 lg:hidden">
      <!-- Logo -->
      <div class="inline-block flex-none rounded-md text-xl font-semibold focus:opacity-80 focus:outline-none">
        PMU
      </div>
      <!-- End Logo -->
    </div>

    <div class="ms-auto flex w-full items-center justify-end gap-x-1 md:justify-between md:gap-x-3">

      <div class="flex grow flex-row items-center justify-end gap-1">
        <button type="button"
                class="size-[38px] relative inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
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
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
          </svg>
          <span class="sr-only">Notifications (Coming Soon)</span>
        </button>

        <!-- Dropdown -->
        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
          <button id="hs-dropdown-account"
                  type="button"
                  class="size-[38px] inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                  aria-haspopup="menu"
                  aria-expanded="false"
                  aria-label="Dropdown">
            <img class="size-[38px] shrink-0 rounded-full"
                 src="{{ Avatar::create(auth()->user()->parentKaryawanProfile()->value('nama_karyawanprofile'))->toBase64() }}"
                 alt="Avatar">
          </button>

          <div class="hs-dropdown-menu duration min-w-60 mt-2 hidden rounded-lg bg-white opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100"
               role="menu"
               aria-orientation="vertical"
               aria-labelledby="hs-dropdown-account">
            <div class="rounded-t-lg bg-gray-100 px-5 py-3">
              <p class="text-sm text-gray-500">Masuk Sebagai</p>
              <p class="text-sm font-medium text-gray-800">
                {{ Str::upper(auth()->user()->parentKaryawanProfile()->value('nama_karyawanprofile')) }}</p>
            </div>
            <div class="space-y-0.5 p-1.5">
              <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                 href="#">
                <i data-lucide="user-pen"
                   class="size-4 shrink-0"></i>
                Profil
              </a>
              <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                 href="{{ route('logout') }}"
                 wire:navigate="false">
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
</header>
