<!DOCTYPE html>
<html class="h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ basset('photos/settings/default_domain.png') }}"rel="icon" type="image/x-icon">
        @basset('vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css')
        
        <style>
            html,
                body {
                height: 100%;
            }

            .form-signin {
                max-width: 330px;
                padding: 1rem;
            }

            .form-signin .form-floating:focus-within {
                z-index: 2;
            }

            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }

            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }

        </style>

        @basset('vendor/popper-2.11.8-dist/umd/popper.min.js')
        @basset('vendor/bootstrap-5.3.3-dist/js/bootstrap.min.js')
        <script src="https://kit.fontawesome.com/286e1d7d30.js" crossorigin="anonymous"></script>
        @basset('vendor/sweetalert2-11.10.8-dist/js/sweetalert2.all.js')

        <title>{{ $title ?? 'RSUP SURVEY' }}</title>
    </head>

    <body class="d-flex align-items-center py-4 mx-auto bg-body-tertiary">

        {{ $slot }}

    </body>
</html>