<div class="card">
    <div class="card-header">
        <h4>Unit Profile Preview</h4>
    </div>
    <div class="card-body m-2">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-4">
                    <div class="card" style="width: 6rem;">
                        <img 
                        class="img-thumbnail rounded"
                        src="{{ asset('/photos/'.$this->unitSubLogo ?? 'default.png') }}" 
                        alt="current_logo_sub">
                    </div>
                </div>
                <div class="col-4 lh-sm">
                    {!! $this->unitAlamat !!}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <h4>{{ $this->unitName }}</h4>
                    {!! $this->unitMotto !!}
                </div>
                <div class="col-6">
                    <div class="card text-center" style="width: 18rem;">
                        <img 
                        class="img-thumbnail rounded"
                        src="{{ asset('/photos/'.$this->unitMainLogo ?? 'default.png') }}" 
                        alt="current_logo_main">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>