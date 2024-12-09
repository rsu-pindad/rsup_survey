<div id="hs-application-sidebar"
     class="hs-overlay fixed inset-y-0 start-0 z-[60] hidden h-full w-[260px] -translate-x-full transform border-e border-gray-200 bg-white transition-all duration-300 [--auto-close:lg] hs-overlay-open:translate-x-0 lg:bottom-0 lg:end-auto lg:block lg:translate-x-0"
     role="dialog"
     tabindex="-1"
     aria-label="Sidebar">
  <div class="relative flex h-full max-h-full flex-col">
    <div class="px-6 pt-4">
      <!-- Logo -->
      <div class="inline-block flex-none rounded-md text-xl font-semibold focus:opacity-80 focus:outline-none">
        PMU
      </div>
      <!-- End Logo -->
    </div>

    <!-- Content -->
    <div
         class="h-full overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-lime-300 [&::-webkit-scrollbar-track]:bg-lime-100 [&::-webkit-scrollbar]:w-2">
      <nav class="hs-accordion-group flex w-full flex-col flex-wrap p-3"
           data-hs-accordion-always-open>
        <ul class="flex flex-col space-y-1">
          <li>
            <a class="@if (request()->route()->getName() === 'office') bg-lime-100 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
               href="{{ route('office') }}"
               wire:navigate="false">
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
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
              </svg>
              Beranda
            </a>
          </li>

          <li id="survey-accordion"
              @class([
                  'hs-accordion',
                  'active' => request()->is('office/survey-masuk/*'),
              ])>
            <button type="button"
                    class="hs-accordion-toggle flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                    aria-expanded="true"
                    aria-controls="survey-accordion-child">
              <svg xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round"
                   class="lucide lucide-file-box size-4 shrink-0">
                <path d="M14.5 22H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                <path
                      d="M3 13.1a2 2 0 0 0-1 1.76v3.24a2 2 0 0 0 .97 1.78L6 21.7a2 2 0 0 0 2.03.01L11 19.9a2 2 0 0 0 1-1.76V14.9a2 2 0 0 0-.97-1.78L8 11.3a2 2 0 0 0-2.03-.01Z" />
                <path d="M7 17v5" />
                <path d="M11.7 14.2 7 17l-4.7-2.8" />
              </svg>
              Survey

              <svg class="size-4 ms-auto hidden hs-accordion-active:block"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="m18 15-6-6-6 6" />
              </svg>

              <svg class="size-4 ms-auto block hs-accordion-active:hidden"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </button>

            <div id="survey-accordion-child"
                 class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                 role="region"
                 aria-labelledby="survey-accordion">
              <ul class="hs-accordion-group space-y-1 ps-8 pt-1"
                  data-hs-accordion-always-open>
                <li id="survey-accordion-sub-1"
                    @class([
                        'hs-accordion',
                        'hs-accordion active' => Route::is('office.survey-masuk.*'),
                    ])>
                  <button type="button"
                          class="hs-accordion-toggle flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                          aria-expanded="true"
                          aria-controls="survey-accordion-sub-1-child">
                    Survey Masuk

                    <svg class="size-4 ms-auto hidden hs-accordion-active:block"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                      <path d="m18 15-6-6-6 6" />
                    </svg>

                    <svg class="size-4 ms-auto block hs-accordion-active:hidden"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                      <path d="m6 9 6 6 6-6" />
                    </svg>
                  </button>

                  <div id="survey-accordion-sub-1-child"
                       @class([
                           'hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300',
                           'hs-accordion-content w-full overflow-auto transition-[height] duration-300' => Route::is(
                               'office.survey-masuk.*'),
                       ])
                       role="region"
                       aria-labelledby="survey-accordion-sub-1">
                    <ul class="ml-2 space-y-1 pt-1">
                      <li>
                        <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                           href="{{ route('survey-masuk-grafik') }}">
                          Grafik
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                           href="{{ route('survey-masuk-tabel') }}">
                          Tabel
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                           href="#">
                          Laporan (Coming soon)
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>

          {{-- <li id="account-accordion"
              class="hs-accordion">
            <button type="button"
                    class="hs-accordion-toggle flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                    aria-expanded="true"
                    aria-controls="account-accordion-child">
              <svg class="size-4 mt-0.5 shrink-0"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <circle cx="18"
                        cy="15"
                        r="3" />
                <circle cx="9"
                        cy="7"
                        r="4" />
                <path d="M10 15H6a4 4 0 0 0-4 4v2" />
                <path d="m21.7 16.4-.9-.3" />
                <path d="m15.2 13.9-.9-.3" />
                <path d="m16.6 18.7.3-.9" />
                <path d="m19.1 12.2.3-.9" />
                <path d="m19.6 18.7-.4-1" />
                <path d="m16.8 12.3-.4-1" />
                <path d="m14.3 16.6 1-.4" />
                <path d="m20.7 13.8 1-.4" />
              </svg>
              Account

              <svg class="size-4 ms-auto hidden hs-accordion-active:block"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="m18 15-6-6-6 6" />
              </svg>

              <svg class="size-4 ms-auto block hs-accordion-active:hidden"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </button>

            <div id="account-accordion-child"
                 class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                 role="region"
                 aria-labelledby="account-accordion">
              <ul class="space-y-1 ps-8 pt-1">
                <li>
                  <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                     href="#">
                    Link 1
                  </a>
                </li>
                <li>
                  <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                     href="#">
                    Link 2
                  </a>
                </li>
                <li>
                  <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
                     href="#">
                    Link 3
                  </a>
                </li>
              </ul>
            </div>
          </li> --}}
          <li>
            <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-lime-100 focus:bg-lime-100 focus:outline-none"
               href="{{ route('home-idle') }}"
               wire:navigate="false">
              <svg xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round"
                   class="lucide lucide-notebook-pen size-4 shrink-0">
                <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4" />
                <path d="M2 6h4" />
                <path d="M2 10h4" />
                <path d="M2 14h4" />
                <path d="M2 18h4" />
                <path
                      d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
              </svg>
              Halaman Survey
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!-- End Content -->
  </div>
</div>
