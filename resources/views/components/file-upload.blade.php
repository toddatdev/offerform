@props(['id'])

@php
    $id = $id ?? md5($attributes->wire('model'));
@endphp

<div id="{{ $id }}"
     x-data="{ isUploadingImage: false, progressImage: 0, photoName: null, photoPreview: null }"
     x-on:livewire-upload-start="isUploadingImage = true"
     x-on:livewire-upload-finish="isUploadingImage = false;"
     x-on:livewire-upload-error="isUploadingImage = false"
     x-on:livewire-upload-progress="progressImage = $event.detail.progress"
>
    <x-input {{ $attributes->merge(['class' => 'form-control form-control-lg upload-change-img']) }}
             {{ $attributes->wire('model') }}
             id="photo-{{ $id }}"
             x-ref="photo"
             x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreview = e.target.result;
                    };
                    reader.readAsDataURL($refs.photo.files[0]);
             "
             type="file"/>
    <div class="progress mt-2" x-show="isUploadingImage" style="height: 15px">
        <div class="progress-bar" role="progressbar"
             :style="`width: ${progressImage}%`"
             x-on:aria-valuenow="progressImage" aria-valuemin="0"
             aria-valuemax="100"
             x-text="`${progressImage}%`"></div>
    </div>
</div>
