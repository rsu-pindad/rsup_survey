<main class="form-signin w-100 h-100 m-auto">
    <form wire:submit="login">
        <img 
            class="img-fluid mb-3"
            src="{{ basset('photos/settings/'.$appSetting->initial_header_logo ?? 'default_header.png') }}" 
            alt="logo" 
            width="280px" 
            height="100px"
        >
        <div
            wire:loading.remove
            class="container p-2 mt-auto mb-auto">
            <div class="input-group has-validation">
                <div class="form-floating @error('form.email') is-invalid @enderror">
                    <input wire:model="form.email"
                        type="email" 
                        class="form-control @error('form.email') is-invalid @enderror" 
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
                <div class="form-floating @error('form.password') is-invalid @enderror">
                    <input 
                        wire:model="form.password"
                        type="password" 
                        class="form-control @error('form.password') is-invalid @enderror" 
                        placeholder="masukan password"
                        id="floatingPassword">
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
                <div wire:target="login"
                    wire:loading
                    class="align-self-center p-2">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="d-flex flex-row justify-content-center p-2">
        <a href="https://www.pindadmedika.com"
            target="_blanks"
            class="m-auto text-body-secondary text-uppercase text-decoration-none">©2024 Rsu Pindad</a>
    </div>
    <x-livewire-alert::scripts />
</main>
