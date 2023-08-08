@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
    <div x-data="{photoName: null, photoPreview: null}">
        <div class="mb-3">
            @if($user->hasRole('agent'))
                <h5 class="fw-bold mb-3">Profile Picture</h5>
            @endif
            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="!photoPreview">
                <img
                    src="{{ $user->profile_photo_url }}"
                    alt="{{ $user->fullName }}"
                    class="w-100 rounded-3"
                    style="min-height: 250px;object-fit: cover"
                />
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <img
                    :src="photoPreview"
                    alt="{{ $user->fullName }}"
                    class="w-100 rounded-3"
                    style="min-height: 250px;object-fit: cover"
                />
            </div>
        </div>

        <div>
            <label for="photo" class="file-upload-label change-img">
                @role('admin')
                <img class="w-18 me-3"
                     src="{{asset('img/menu-icons/upload-icon.svg')}}"
                     alt=""
                />
                @endrole
                Select Image
            </label>
            <div class="text-start mt-2"
                 x-data="{ isUploadingImage: false, progressImage: 0 }"
                 x-on:livewire-upload-start="isUploadingImage = true"
                 x-on:livewire-upload-finish="isUploadingImage = false;"
                 x-on:livewire-upload-error="isUploadingImage = false"
                 x-on:livewire-upload-progress="progressImage = $event.detail.progress"
            >

                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="d-none"
                       {{ $attributes->wire('model') }}
                       x-ref="photo"
                       x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreview = e.target.result;
                    };
                    reader.readAsDataURL($refs.photo.files[0]);
               "/>

                <div class="progress mt-2" x-show="isUploadingImage" style="height: 15px">
                    <div class="progress-bar" role="progressbar"
                         :style="`width: ${progressImage}%`"
                         x-on:aria-valuenow="progressImage" aria-valuemin="0"
                         aria-valuemax="100"
                         x-text="`${progressImage}%`"></div>
                </div>
            </div>
        </div>
    </div>
@endif
