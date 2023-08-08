@php
    $uploadedFiles = $this->defaultOrValue;

    if ($uploadedFiles === '') $uploadedFiles = [];

@endphp
<div
    class="mt-4 w-full-md-75"
    style="transition: all 0.5s ease"
    x-data="{isFileDropping: false, isUploadingFile: false, uploadingProgress: 0}"
    x-on:drop="isFileDropping = false"
    x-on:drop.prevent="
         if ($event.dataTransfer.files.length > 0) {
            isUploadingFile = true;
            @this.uploadMultiple(
                'formFile',
                $event.dataTransfer.files,
                (uploadedFilename) => {
                    isUploadingFile = false;
                     @this.onFormFileUpload();
                },
                () => {
                    conosle.log('ok');
                },
                (event) => {
                    uploadingProgress = event.detail.progress;
                });
        }
    "
    x-on:dragover.prevent="isFileDropping = true"
    x-on:dragleave.prevent="isFileDropping = false"
>
    <div
        x-show="isFileDropping"
        style="display: none; border-style: dashed !important; pointer-events: none"
        class="border border-primary rounded py-5 justify-content-center align-items-center"
        :class="{'d-flex': isFileDropping}"
    >
        <p class="mb-0">Drop file's here to upload...</p>
    </div>
    <div x-show="!isFileDropping" class="py-5" :style="`pointer-events: ${!isFileDropping ? 'auto' : 'none'}`">
        <div class="text-start"
             x-on:livewire-upload-start="isUploadingFile = true"
             x-on:livewire-upload-finish="isUploadingFile = false; @this.onFormFileUpload();"
             x-on:livewire-upload-error="isUploadingFile = false"
             x-on:livewire-upload-progress="uploadingProgress = $event.detail.progress"
        >
            <x-input
                id="file_upload_{{ $stepSection->id }}"
                type="file"
                hidden="hidden"
                wire:model="formFile"
            />
            <div class="progress my-2" x-show="isUploadingFile"
                 style="height: 15px; display: none">
                <div class="progress-bar" role="progressbar" :style="`width: ${uploadingProgress}%`"
                     x-on:aria-valuenow="uploadingProgress" aria-valuemin="0" aria-valuemax="100"
                     x-text="`${uploadingProgress}%`"></div>
            </div>
        </div>

        @if(is_array($formFile))
            @foreach($formFile as $file)
                <a href="{{ $file->temporaryUrl() }}" class="text-primary" target="_blank" class="text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-paperclip"
                         viewBox="0 0 16 16">
                        <path
                            d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                    </svg>
                    {{ $file->getClientOriginalName() }}
                </a>
                @if(!$loop->last)
                    <span class="mx-2">|</span>
                @endif
            @endforeach
            <br/>
        @elseif($formFile)
            <a href="{{ $formFile->temporaryUrl() }}" class="text-primary" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-paperclip"
                     viewBox="0 0 16 16">
                    <path
                        d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                </svg>
                {{ $formFile->getClientOriginalName() }}
            </a>
            <br />
        @elseif(is_array($uploadedFiles))
            @foreach($uploadedFiles as $uploadedFile)
                <a href="/storage/{{ $uploadedFile['download_link'] }}" class="text-primary" target="_blank" class="text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-paperclip"
                         viewBox="0 0 16 16">
                        <path
                            d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                    </svg>
                    {{ $uploadedFile['original_name'] }}
                </a>
                @if(!$loop->last)
                    <span class="mx-2">|</span>
                @endif
            @endforeach
            <br/>
        @endif
        <button
            type="button"
            id="custom-button"
            class="btn btn-primary-light rounded-3 px-3 text-white"
            onclick='document.getElementById("file_upload_{{ $stepSection->id }}").click()'
        >
            CHOOSE FILE
        </button>

        <span id="custom-text" class="ms-3 fw-500">
            @if(is_array($formFile))
                {{ count($formFile) }} file's chosen
            @elseif($formFile)
                1 file chosen
            @else
                No file chosen
            @endif
        </span>
    </div>

</div>
