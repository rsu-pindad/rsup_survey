<div class="container">
    <header class="border-bottom lh-2 py-4">
        <div class="row justify-content-center px-2">
        <div class="col-lg-4 col-md-3 col-xs-2 d-none d-xs-none d-md-block">
            <img 
            class="m-2 px-2" 
            src="https://psurvey.pindadmedika.com/_next/image?url=%2Frsu-pindad.png&w=384&q=75" 
            alt="logo" 
            width="150" 
            height="auto">
        </div>
        <div class="col-lg-4 col-md-6 col-xs-8 d-none d-xs-none d-md-block">
            <div class="text-center text-body-emphasis text-decoration-none text-wrap fs-6">
            {!! $unitAlamat !!}
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-xs-2 d-xs-block d-md-block">
            <div class="d-flex flex-row-reverse m-2 px-2 justify-content-center">
                <a class="btn btn-sm btn-outline-secondary mx-2 align-self-center" href="{{ route('logout') }}">Keluar</a>
                <a class="btn btn-sm btn-outline-secondary mx-2 align-self-center text-truncate" href="#"> ({{ $layanan }}) {{ $petugas }}</a>
            </div>
        </div>
        </div>
    </header>
</div>