<!-- ========== FOOTER ========== -->
<footer class="relative mt-auto w-full @if (Route::currentRouteName() == 'survey-pasien') hidden sm:hidden lg:block md:hidden xl:block @endif">
  <div class="fixed bottom-0 left-0 right-0 max-w-full border-t border-gray-200 px-6 py-4">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <p class="text-md font-bold text-gray-600">
          © 2024 PT Pindad Medika Utama.
        </p>
      </div>
      <!-- End Col -->
      <!-- List -->
      <ul class="text-sm flex flex-wrap items-center">
        <li
            class="before:size-[3px] relative inline-block pe-4 text-sm before:absolute before:end-1.5 before:top-1/2 before:-translate-y-1/2 before:rounded-full before:bg-gray-400 last:pe-0 last-of-type:before:hidden">
          <a class="inline-flex items-center gap-x-1 text-sm text-gray-800 hover:decoration-2 focus:decoration-2 focus:outline-none"
             href="#">
            <i data-lucide="facebook"></i>Facebook
          </a>
        </li>
        <li
            class="before:size-[3px] relative inline-block pe-4 text-sm before:absolute before:end-1.5 before:top-1/2 before:-translate-y-1/2 before:rounded-full before:bg-gray-400 last:pe-0 last-of-type:before:hidden">
          <a class="inline-flex items-center gap-x-1 text-sm text-gray-800 hover:decoration-2 focus:decoration-2 focus:outline-none"
             href="#">
            <i data-lucide="instagram"></i>Instragram
          </a>
        </li>
        <li
            class="before:size-[3px] relative inline-block pe-4 text-sm before:absolute before:end-1.5 before:top-1/2 before:-translate-y-1/2 before:rounded-full before:bg-gray-400 last:pe-0 last-of-type:before:hidden">
          <a class="inline-flex items-center gap-x-1 text-sm text-gray-800 hover:decoration-2 focus:decoration-2 focus:outline-none"
             href="#">
            <i data-lucide="twitter"></i>X (Twitter)
          </a>
        </li>
        <li class="inline-block pe-4 text-sm">
          <a class="inline-flex items-center gap-x-1 text-sm text-gray-800 hover:decoration-2 focus:decoration-2 focus:outline-none"
             href="#">
            <i data-lucide="youtube"></i>Youtube
          </a>
        </li>
      </ul>
      <!-- End List -->
    </div>
  </div>
</footer>
<!-- ========== END FOOTER ========== -->
