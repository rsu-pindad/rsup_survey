<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @basset('vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css')
        @basset('vendor/jodit-4.0.1-dist/css/jodit.min.css')
        
        @stack('styles')
        @once
            @push('styles')
                @lagoonStyles
            @endpush
        @endonce

        @basset('vendor/popper-2.11.8-dist/umd/popper.min.js')
        @basset('vendor/bootstrap-5.3.3-dist/js/bootstrap.min.js')
        <script src="https://kit.fontawesome.com/286e1d7d30.js" crossorigin="anonymous"></script>
        @basset('vendor/sweetalert2-11.10.8-dist/js/sweetalert2.all.js')
        @basset('vendor/jodit-4.0.1-dist/js/jodit.min.js')

        @stack('scripts')

        <title>{{ $title ?? 'RSUP SURVEY' }}</title>
    </head>

    @if(Route::currentRouteName() == 'login')
    <body class="d-flex align-items-center py-4 bg-body-tertiary">
    @elseif(Route::currentRouteName() == 'root-guest')
    <body class="d-flex align-items-center py-4 bg-body-tertiary">
    @else
    <body>
    @endif
        
        {{ $slot }} 

        @yield('contents')

        @yield('modals')

        @stack('custom-script')
        @once
            @push('custom-script')
                @lagoonScripts({{ app()->getLocale() }})
            @endpush
        @endonce

        <x-livewire-alert::scripts />
        
    </body>
</html>
