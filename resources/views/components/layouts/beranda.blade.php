<!DOCTYPE html>
<html class="h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link 
            src="{{ basset('photos/settings/default_domain.png') }}"
            rel="icon" 
            type="image/x-icon">

        @basset('vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css')
        @basset('cover.css')

        @stack('styles')

        @basset('vendor/popper-2.11.8-dist/umd/popper.min.js')
        @basset('vendor/bootstrap-5.3.3-dist/js/bootstrap.min.js')
        <script src="https://kit.fontawesome.com/286e1d7d30.js" crossorigin="anonymous"></script>
        @basset('vendor/sweetalert2-11.10.8-dist/js/sweetalert2.all.js')

        @stack('scripts')

        <title>{{ $title ?? 'RSUP SURVEY' }}</title>
    </head>

    <body class="d-flex h-100 text-center">
        
        {{ $slot }}

        @stack('custom-scripts')

        <x-livewire-alert::scripts />

    </body>
</html>