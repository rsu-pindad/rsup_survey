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
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="h-screen w-screen bg-gradient-to-r from-white from-90% to-slate-200 font-sans antialiased">

    <x-preline.header-home />
    <x-wireui-dialog />
    <x-wireui-notifications />

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content"
          class="py-auto mx-auto max-h-full px-4">
      {{ $slot }}
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <x-preline.footer-home />

    {{-- <x-wireui-modal />
    <x-wireui-dialog position="center" />
    <x-wireui-notifications position="top-end" /> --}}

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
    {{-- @livewireScripts --}}
    @livewireScriptConfig
  </body>

</html>
