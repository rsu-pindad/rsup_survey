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

  <body>
    {{ $slot }}
    {{-- @livewireScripts --}}
    @livewireScriptConfig
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
  </body>

</html>
