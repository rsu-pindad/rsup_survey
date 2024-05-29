<div>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand m-2" href="/">
                <img 
                @if(env('APP_ENV') == 'local')
                src="{{ asset('storage/basset/photos/settings/'.$appSetting->initial_domain_logo ?? 'default_domain.png') }}"
                @else
                src="{{ asset('public/photos/settings/'.$appSetting->initial_domain_logo ?? 'default_domain.png') }}"
                @endif 
                alt="Logo" width="34" height="28" class="d-inline-block align-text-top"
                />
            </a>
            <button 
                class="navbar-toggler m-2" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarCollapseSLU" 
                aria-controls="navbarCollapseSLU" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
                <i class="fa-solid fa-circle-chevron-down"></i>
            </button>
            <button 
                class="navbar-toggler m-2" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarCollapse" 
                aria-controls="navbarCollapse" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <button 
                class="navbar-toggler m-2" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarCollapseSelf" 
                aria-controls="navbarCollapseSelf" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
                <i class="fa-solid fa-id-badge"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapseSLU">
                <ul class="navbar-nav me-auto mb-2 mb-md-0 mx-auto">
                    @cannot('view_petugas')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page-survey" href="{{ route('root-survey-petugas', ['id' => Auth()->user()->id]) }}" wire:navigate="false">Survey</a>
                    </li>
                    @endcannot
                    @can('view_laporan')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page-laporan" href="{{ route('root-laporan') }}" wire:navigate="false">Laporan</a>
                    </li>
                    @endcannot
                    @can('view_unit')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page-unit" href="{{ route('root-unit') }}" wire:navigate="false">Unit</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0 mx-auto">
                    @can('view_karyawan_data')
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Karyawan
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('root-karyawan') }}" wire:navigate="false">Karyawan</a></li>
                        <li><a class="dropdown-item" href="{{ route('root-karyawan-profile') }}" wire:navigate="false">Karyawan Profile</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('view_set_survey')
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Set Survey
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('root-layanan-respon') }}" wire:navigate="false">Layanan-Respon</a></li>
                        <li><a class="dropdown-item" href="{{ route('root-penjamin-layanan') }}" wire:navigate="false">Penjamin-Layanan</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('view_master_data')
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Master Data
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                        @can('view_layanan')
                        <li><a class="dropdown-item" href="{{ route('root-layanan') }}" wire:navigate="false">Layanan</a></li>
                        @endcan
                        @can('view_penjamin')
                        <li><a class="dropdown-item" href="{{ route('root-penjamin') }}" wire:navigate="false">Penjamin</a></li>
                        @endcan
                        @can('view_respon')
                        <li><a class="dropdown-item" href="{{ route('root-respon') }}" wire:navigate="false">Respon</a></li>
                        @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('view_users_data')
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('root-super-admin-user') }}" wire:navigate="false">User</a></li>
                        <li><a class="dropdown-item" href="{{ route('root-super-admin-permission') }}" wire:navigate="false">Permission</a></li>
                        <li><a class="dropdown-item" href="{{ route('root-super-admin-role') }}" wire:navigate="false">Role</a></li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapseSelf">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ \Illuminate\Support\Str::limit(session()->get('userName'), 6, '..') }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('root-self') }}" wire:navigate="false">Pengaturan</a></li>
                        <li><a class="dropdown-item" href="#">Notifikasi</a></li>
                        @hasexactroles('super-admin')
                        <li><a class="dropdown-item" href="{{ route('root-setting-app') }}" wire:navigate="false">App Profile</a></li>
                        @endhasexactroles
                        <li><a class="dropdown-item" href="{{ route('logout') }}" wire:navigate="false">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

@push('styles')
<style>
    body {
    min-height: 75rem;
    padding-top: 4.5rem;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
    }
</style>
@endpush