<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">

    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="h-screen font-sans antialiased">

    @if (Route::currentRouteName() !== 'home-idle')
      <x-preline.header />
    @endif

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content"
          class="size-auto before:size-auto relative m-auto my-20 flex flex-col justify-center px-4 before:absolute before:start-1/2 before:top-0 before:-z-[1] before:-translate-x-1/2 before:transform before:bg-top before:bg-no-repeat sm:items-center sm:px-6 lg:px-8">
      {{ $slot }}
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <x-preline.footer />

    <script type="module">
      document.addEventListener("DOMContentLoaded", () => {
        window.HSStaticMethods.autoInit();
      });
      document.addEventListener("livewire:navigated", () => {
        window.HSStaticMethods.autoInit();
      });
    </script>
    @livewireScripts
  </body>

</html>
