<div
    x-cloak
    x-data="dropzone({
        _this: @this,
        uuid: @js($uuid),
        multiple: @js($multiple),
    })"
    @dragenter.prevent.document="onDragenter($event)"
    @dragleave.prevent="onDragleave($event)"
    @dragover.prevent="onDragover($event)"
    @drop.prevent="onDrop"
    class="form-control"
>
    <div class="container">
        @if(! is_null($error))
            <div class="dz-bg-red-50 dz-p-4 dz-w-full dz-mb-4 dz-rounded dark:dz-bg-red-600">
                <div class="dz-flex dz-gap-3 dz-items-start">
                    <i class="fa-solid fa-ban"></i>
                    <h3 class="dz-text-sm dz-text-red-800 dz-font-medium dark:dz-text-red-100">{{ $error }}</h3>
                </div>
            </div>
        @endif
        <div class="dz-flex dz-justify-between dz-w-full">
            <label for="upload" class="dz-font-medium dz-text-lg dz-mb-2 dz-text-black dark:dz-text-white">{{ __('Upload files') }} <span class="dz-text-red-500">*</span></label>
            <div x-show="isLoading" role="status">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <span class="dz-sr-only">Loading...</span>
            </div>
        </div>
        <div @click="$refs.input.click()" class="dz-border dz-border-dashed dz-rounded dz-border-gray-500 dz-w-full dz-cursor-pointer">
            <div>
                <div x-show="!isDragging" class="dz-flex dz-items-center dz-bg-gray-50 dz-justify-center dz-gap-2 dz-py-8 dz-h-full dark:dz-bg-gray-700">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    <p class="dz-text-md dz-text-gray-600 dark:dz-text-gray-400">Drop here or <span class="dz-font-semibold dz-text-black dark:dz-text-white">Browse files</span></p>
                </div>
                <div x-show="isDragging" class="dz-flex dz-items-center dz-bg-gray-100 dz-justify-center dz-gap-2 dz-py-8 dz-h-full">
                    <i class="fa-solid fa-upload"></i>
                    <p class="dz-text-md dz-text-gray-600 dark:dz-text-gray-400">Drop here to upload</p>
                </div>
            </div>
            <input
                    x-ref="input"
                    wire:model="upload"
                    type="file"
                    class="dz-hidden"
                    x-on:livewire-upload-start="isLoading = true"
                    x-on:livewire-upload-finish="isLoading = false"
                    x-on:livewire-upload-error="console.log('livewire-dropzone upload error', error)"
                    @if(! is_null($this->accept)) accept="{{ $this->accept }}" @endif
                    @if($multiple === true) multiple @endif
            >
        </div>

        <div class="dz-flex dz-items-center dz-gap-2 dz-text-gray-500 dz-text-sm dz-mt-2">
            @php
                $hasMaxFileSize = ! is_null($this->maxFileSize);
                $hasMimes = ! empty($this->mimes);
            @endphp

            @if($hasMaxFileSize)
                <p>{{ __('Up to :size', ['size' => \Illuminate\Support\Number::fileSize($this->maxFileSize * 1024)]) }}</p>
            @endif

            @if($hasMaxFileSize && $hasMimes)
                <span class="w-1 h-1 text-gray-400">·</span>
            @endif

            @if($hasMimes)
                <p>{{ Str::upper($this->mimes) }}</p>
            @endif
        </div>


        @if(count($files) > 0)
            <div class="dz-flex dz-flex-wrap dz-gap-x-10 dz-gap-y-2 dz-justify-start dz-w-full dz-mt-5">
                @foreach($files as $file)
                    <div class="dz-flex dz-items-center dz-justify-between dz-gap-2 dz-border dz-rounded dz-border-gray-200 dz-w-full dz-h-auto dz-overflow-hidden dark:dz-border-gray-700">
                        <div class="dz-flex dz-items-center dz-gap-3">
                            @if($this->isImageMime($file['extension']))
                                <div class="dz-flex-none dz-w-14 dz-h-14">
                                    <img src="{{ $file['temporaryUrl'] }}" class="dz-object-fill dz-w-full dz-h-full" alt="{{ $file['name'] }}">
                                </div>
                            @else
                                <div class="dz-flex dz-justify-center dz-items-center dz-w-14 dz-h-14 dz-bg-gray-100 dark:dz-bg-gray-700">
                                    <i class="fa-regular fa-file-image"></i>
                                </div>
                            @endif
                            <div class="dz-flex dz-flex-col dz-items-start dz-gap-1">
                                <div class="dz-text-center dz-text-slate-900 dz-text-sm dz-font-medium dark:dz-text-slate-100">{{ $file['name'] }}</div>
                                <div class="dz-text-center dz-text-gray-500 dz-text-sm dz-font-medium">{{ \Illuminate\Support\Number::fileSize($file['size']) }}</div>
                            </div>
                        </div>
                        <div class="dz-flex dz-items-center dz-mr-3">
                            <button type="button" @click="removeUpload('{{ $file['tmpFilename'] }}')" class="btn btn-danger">
                                <i class="fa-solid fa-trash-arrow-up"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @script
    <script>
        Alpine.data('dropzone', ({ _this, uuid, multiple }) => {
            return ({
                isDragging: false,
                isDropped: false,
                isLoading: false,

                onDrop(e) {
                    this.isDropped = true
                    this.isDragging = false

                    const file = multiple ? e.dataTransfer.files : e.dataTransfer.files[0]

                    const args = ['upload', file, () => {
                        // Upload completed
                        this.isLoading = false
                    }, (error) => {
                        // An error occurred while uploading
                        console.log('livewire-dropzone upload error', error);
                    }, () => {
                        // Uploading is in progress
                        this.isLoading = true
                    }];

                    // Upload file(s)
                    multiple ? _this.uploadMultiple(...args) : _this.upload(...args)
                },
                onDragenter() {
                    this.isDragging = true
                },
                onDragleave() {
                    this.isDragging = false
                },
                onDragover() {
                    this.isDragging = true
                },
                removeUpload(tmpFilename) {
                    // Dispatch an event to remove the temporarily uploaded file
                    _this.dispatch(uuid + ':fileRemoved', { tmpFilename })
                },
            });
        })
    </script>
    @endscript
</div>
