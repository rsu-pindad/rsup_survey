<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">

    <title>{{ $title ?? 'Page Title' }}</title>
    {{-- @livewireStyles --}}
    {{-- <wireui:scripts /> --}}
    {{-- @livewireScriptConfig --}}
    {{-- @livewireScripts --}}
    
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="h-screen w-screen bg-gray-50 transition-all duration-300 lg:hs-overlay-layout-open:ps-[260px]">

    @livewireScriptConfig
    @livewireChartsScripts

    <x-wireui-dialog />
    <x-wireui-notifications />

    <!-- ========== HEADER ========== -->
    <x-preline.office.header-office />
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <div class="-mt-px">
      <!-- Breadcrumb -->
      <x-preline.office.breadcrumb-office />
      <!-- End Breadcrumb -->
    </div>

    <!-- Sidebar -->
    <x-preline.office.sidebar-office />
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full lg:ps-64">
      <div class="space-y-4 p-4 sm:space-y-6 sm:p-6">
        {{ $slot }}
      </div>
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->
    <script type="module">
      document.addEventListener("DOMContentLoaded", (e) => {
        window.HSStaticMethods.autoInit();
        e.preventDefault();
      });
      document.addEventListener("livewire:navigated", (e) => {
        window.HSStaticMethods.autoInit();
        e.preventDefault();
      });
    </script>
    @stack('customScripts')
  </body>

</html>
