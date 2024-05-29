<div class="card">
    <div class="card-header">
        <h4>Unit Profile Preview</h4>
    </div>
    <div class="card-body m-2">
        <div class="container">
            <div class="row mb-2">
                <div class="col-3">
                    <div class="card" style="width: 6rem;">
                        <img 
                        class="img-thumbnail rounded"
                        @if(env('APP_ENV') == 'local')
                        src="{{ asset('storage/basset/photos/'.$this->unitSubLogo ?? 'defaultsub.png') }}" 
                        @else
                        src="{{ asset('public/photos/'.$this->unitSubLogo ?? 'defaultsub.png') }}"
                        @endif
                        alt="current_logo_sub">
                    </div>
                </div>
                <div class="col-6 lh-sm">
                    {!! $this->unitAlamat !!}
                </div>
                <div class="col-3">
                    {{ auth()->user()->name }}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <h4>{{ $this->unitName }}</h4>
                    {!! $this->unitMotto !!}
                </div>
                <div class="col-6">
                    <div class="card" style="width: 18rem;">
                        <img 
                            class="img-thumbnail rounded"
                            @if(env('APP_ENV') == 'local')
                            src="{{ asset('storage/basset/photos/'.$this->unitMainLogo ?? 'defaultmain.png') }}" 
                            @else
                            src="{{ asset('public/photos/'.$this->unitMainLogo ?? 'defaultmain.png') }}"
                            @endif
                            alt="current_logo_main">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>