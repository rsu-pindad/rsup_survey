<div class="container-fluid">
    <a href="#" class="float-md-start mb-0 navbar-brand py-3 d-none d-xs-none d-sm-none d-md-block">
        <img 
            class="d-inline-block align-text-top img-thumbnail"
            src="{{ basset('photos/'.$subLogo ?? 'default_domain.png') }}" 
            @endif
            alt="logo"
            >
    </a>
    <nav class="nav nav-masthead justify-content-end float-md-end d-flex flex-column py-0">
        <a class="fw-bold text-decoration-none btn btn-outline-success mb-1" href="#">({{ $layanan }})</br>{{ \Illuminate\Support\Str::limit($petugas, 5, '..') }}</a>
        <a class="text-decoration-none btn btn-outline-info" href="{{ route('logout') }}">Keluar</a>
    </nav>
    <nav class="nav nav-masthead justify-content-center float-md-center fs-6 py-0 d-none d-xs-none d-sm-none d-md-block" style="line-height:1 !important;">
        <a class="nav-link alamat-link pb-0 px-0" href="#" >{!! $unitAlamat !!}</a>
    </nav>
</div>

{{-- <div class="container">
    <header class="border-bottom lh-1 py-3"> --}}
        {{-- <div>
            <img 
                class="float-md-start mb-0 img-fluid" 
                @if(env('APP_ENV') == 'local')
                src="{{ asset('storage/basset/photos/'.$subLogo ?? 'default_domain.png') }}" 
                @else
                src="{{ asset('public/photos/'.$subLogo ?? 'default_domain.png') }}"
                @endif
                alt="logo"
            >
            <nav class="nav nav-masthead justify-content-center float-md-end">
                <a class="nav-link fw-bold py-1 px-0 text-decoration-none" href="#">
                {{ $unitAlamat }}
                </a>
                <a class="nav-link fw-bold py-1 px-0 align-self-center" href="{{ route('logout') }}">Keluar</a>
                <a class="nav-link fw-bold py-1 px-0 align-self-center text-truncate" href="#"> ({{ $layanan }}) {{ $petugas }}</a>
            </nav>
        </div> --}}
    {{-- </header>
</div> --}}