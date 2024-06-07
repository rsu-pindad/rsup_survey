<main class="form-signin w-100 h-100 m-auto">
    <div class="row">
        <form wire:submit="login">
            <img 
                class="img-fluid" 
                @if(env('APP_ENV') == 'local')
                src="{{ asset('storage/basset/photos/settings/'.$appSetting->initial_header_logo ?? 'default_header.png') }}" 
                @else
                src="{{ asset('public/photos/settings/'.$appSetting->initial_header_logo ?? 'default_header.png') }}"
                @endif
                alt="logo" 
                width="280pt" 
                height="auto"
            >
            
            <div class="p-2 mt-3">
                <div class="input-group has-validation">
                    <div 
                        @error('form.email')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror
                        >
                        <input wire:model="form.email"
                            type="email" 
                            @error('form.email')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            autocomplete="on"
                            placeholder="masukan email"
                            value="{{ old('form.email', '') }}">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.email') 
                        <span class="error text-warning-emphasis">
                            {{ $message }}
                        </span> 
                        @enderror
                    </div>
                </div>
                <div class="input-group has-validation">
                    <div
                        @error('form.password')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror 
                        >
                        <input 
                            wire:model="form.password"
                            type="password" 
                            @error('form.password')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            placeholder="masukan password"
                            id="floatingPassword" 
                            autocomplete="on">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.password') 
                        <span class="error text-warning-emphasis">
                            {{ $message }}
                        </span> 
                        @enderror
                    </div>
                </div>
                <div class="form-check">
                    <input 
                        wire:model="form.remember"
                        class="form-check-input" 
                        type="checkbox" 
                        id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Ingat saya
                    </label>
                </div>
                <div class="container-fluid">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="align-self-center p-2">
                            <button 
                                wire:loading.attr="disabled"
                                wire:loading.remove
                                class="btn btn-primary w-100 py-2" 
                                type="submit">Masuk</button>
                        </div>
                        <div class="align-self-center p-2">
                                <i wire:loading 
                                class="fa-solid fa-spinner"></i>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="d-flex flex-row justify-content-center p-2">
            <a target="_blanks"
                href="https://www.pindadmedika.com"
                class="m-auto text-body-secondary text-uppercase text-decoration-none">©2024 Rsu Pindad</a>
        </div>
    </div>
</main>

@push('styles')
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
