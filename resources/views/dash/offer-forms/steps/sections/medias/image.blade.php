@push('stylesheets')
    <style>
        ::placeholder {
            text-align: left !important;
            color: #00000050 !important;
            font-size: 16px !important;
        }

        .chooseImg, .chooseVideo {
            text-align: left !important;
            color: #00000050 !important;
            font-size: 16px !important;
            padding: 10px;
        }

        .imgVidWith {
            width: 97%;
        }

        .checkInput:checked[type=radio] {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjMiIGhlaWdodD0iNTkiIHZpZXdCb3g9IjAgMCA2MyA1OSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGVsbGlwc2UgY3g9IjMxLjA1MjgiIGN5PSIyOS4zODczIiByeD0iMzEuMDUyOCIgcnk9IjI5LjM4NzMiIGZpbGw9IiM5QzRFREQiLz4KPC9zdmc+Cg==) !important;
        }

        .checkInput:checked {
            background-color: #9C4EDD;
            border-color: #9C4EDD;
            width: 18px !important;
            height: 18px !important;
        }

        @media (max-width: 992px) {
            .imgVidWith {
                width: 95%;
            }
        }
    </style>
@endpush

@if($routeIsEdit)
    <div
        x-data="{
            mediaEdit: false,
            videoUrl: '',
            mediaSettingWizard: 0,
            mediaUploadType: null,
            isAlreadyUploaded: !!{{ isset($mediaConfig['image']) ? 1 : 0}},
            isRecordUploading: false,
            recordUploadProgress: 0,
            player: null,
            blob: null,
            initPlayer() {
                this.blob = null;
                if(this.player) {
                    this.player.record().getDevice();
                    return;
                }

                // instantiate Video.js
                this.player = videojs($refs.video_player, {
                    controls: true,
                    fluid: false,
                    bigPlayButton: true,
                    controlBar: {
                        volumePanel: false,
                        fullscreenToggle: false
                    },
                    // dimensions of the video.js player
                    width: 640,
                    height: 480,
                    plugins: {
                        record: {
                            debug: true,
                            imageOutputType: 'blob',
                            imageOutputFormat: 'image/png',
                            imageOutputQuality: 0.92,
                            image: {
                              // image media constraints: set resolution of camera
                              //width: { min: 640, ideal: 640, max: 1280 },
                              //height: { min: 480, ideal: 480, max: 920 }
                            },
                            // dimensions of captured video frames
                            frameWidth: 640,
                            frameHeight: 480
                        }
                    }
              }, () => {
                    // print version information at startup
                    // print version information at startup
                    var msg = 'Using video.js ' + videojs.VERSION +
                        ' with videojs-record ' + videojs.getPluginVersion('record');
                    videojs.log(msg);
                });

                // device is ready
                this.player.on('deviceReady', () => {
                    console.log('device is ready!');
                });

                // user clicked the record button and started recording
                this.player.on('startRecord', () => {
                    console.log('started recording!');
                    this.blob = null;
                });

                // user completed recording and stream is available
                this.player.on('finishRecord', () => {
                    // recordedData is a blob object containing the recorded data that
                    // can be downloaded by the user, stored on server etc.
                    console.log('finished recording: ', this.player.recordedData);
                    this.blob = this.player.recordedData;
                });

                // error handling
                this.player.on('error', (element, error) => {
                    @this.emit('showToast', 'Error!', error, 1);
                    console.warn(error);
                });

                this.player.on('deviceError', () => {
                    @this.emit('showToast', 'Error!', this.player.deviceErrorCode, 1);
                    console.error('device error:', this.player.deviceErrorCode);
                });
            },
            disposePlayer() {
                if (this.player) {
                    this.player.record().stopDevice();
                }
            },
            uploadRecordedImage() {
                this.isRecordUploading = true;
                let file = new File([this.blob], this.blob.name,{type: this.blob.type, lastModified:new Date().getTime()}, 'utf-8');
                let container = new DataTransfer();
                container.items.add(file);
                @this.upload('stepSectionMediaImageOrVideo', container.files[0], (uploadedFilename) => {
                        // Success callback.
                        @this.onChangeSectionMediaImageOrVideo('image');
                        this.isRecordUploading = false;
                        this.recordUploadProgress = 0;
                        this.blob = null;
                        @this.emit('showToast', 'Success!', 'Captured photo uploaded and saved successfully.');
                        this.isAlreadyUploaded = true;
                    }, () => {
                        @this.emit('showToast', 'Error!', 'Unable to upload your photo please try again.', 1);
                        this.isRecordUploading = false;
                        this.recordUploadProgress = 0;
                    }, (event) => {
                        console.log(event);
                        // Progress callback.
                        // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                        this.recordUploadProgress = event.detail.progress;
                    });
            }
        }"
        class="mb-1"
        style="min-height: 350px; transition: height 4s"
    >
        {{-- Section Edit Area [Start] --}}
        <div
            x-show="mediaEdit"
            @click.away="mediaEdit = false; disposePlayer(); mediaSettingWizard = 0; "
            class="p-4"
            style="display: none;"
        >
            <div style="min-height: 500px" class="position-relative">
                {{-- Header of the Section [Start] --}}
                <p class="mb-0 font-weight-bold" style="position: absolute; right: 15px">
                    Section: {{ $loopIndex + 1 }}
                </p>
                <img
                    class="img-fluid md-icon mb-3"
                    src="{{asset('img/form-builder/icons/grid.svg')}}"
                    style="cursor: move"
                    alt="{{ $stepSection->title }}"
                    wire:sortable.handle
                />
                {{-- Header of the Section [End] --}}

                {{-- Step: 1 --}}
                <div x-show="mediaSettingWizard === 0">
                    <p class="text-center mt-4">This will attach a custom Image on the first step of the OfferForm.</p>
                    <div class="w-full-md-50 py-3 my-3 px-3 px-lg-5">
                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center align-items-center mb-4 rounded-3 px-3 w-100"
                            @click.prevent="mediaSettingWizard = 1;"
                        >
                            <img src="{{asset('v1.1/icons/plus-white-icon.svg')}}"  class="w-24" alt="">
                            <span class="ms-4">Add New Photo</span>

                        </a>

                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover justify-content-center align-items-center mb-4 rounded-3 px-3 w-100"
                            @click.prevent="mediaSettingWizard = 2; mediaUploadType = 'upload'"
                            :class="{'d-flex': isAlreadyUploaded}"
                            x-show="isAlreadyUploaded"
                        >
                            <img src="{{asset('v1.1/icons/edit-white-pencil-icon.svg')}}"  class="w-24" alt="">
                            <span class="ms-4">Edit Current Photo</span>

                        </a>

                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center align-items-center mb-4 rounded-3 px-3 w-100"
                            @click.prevent="mediaEdit = false"
                        >
                            Back
                        </a>

                    </div>
                </div>

                {{-- Step: 2 --}}
                <div x-show="mediaSettingWizard === 1">
                    <div class="w-full-md-50 py-5 my-3 px-3 px-lg-5">
                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100"
                            @click.prevent="mediaUploadType = 'take'; mediaSettingWizard = 2; initPlayer()"
                        >
                            <img src="{{asset('v1.1/icons/take-photo-icon.svg')}}"  class="w-24" alt="">
                            <span class="ms-4">Take Photo</span>

                        </a>

                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100"
                            @click.prevent="mediaUploadType = 'upload'; mediaSettingWizard = 2"
                        >
                            <img src="{{asset('v1.1/icons/upload-icon.svg')}}"  class="w-24" alt="">
                            <span class="ms-4">Upload Photo</span>

                        </a>
                    </div>
                </div>
                {{-- Step: 3 --}}
                <div x-show="mediaSettingWizard >= 2">
                    {{-- Media Type Record Step: 2 --}}
                    <div class="w-full-md-75 py-3" x-show="mediaUploadType === 'take' && mediaSettingWizard === 2">
                        <div wire:ignore class="recordImageModule d-flex justify-content-center align-items-center">
                            <video x-ref="video_player" playsinline class="video-js vjs-default-skin rounded"></video>
                        </div>
                        <div class="progress my-2" x-show="isRecordUploading" style="height: 15px">
                            <div class="progress-bar" role="progressbar"
                                 :style="`width: ${recordUploadProgress}%`"
                                 x-on:aria-valuenow="recordUploadProgress" aria-valuemin="0"
                                 aria-valuemax="100" x-text="`${recordUploadProgress}%`"></div>
                        </div>

                        <button
                            class="btn btn-lg capitalize btn-primary-light-black-hover mb-5 mt-2 justify-content-center align-items-center mb-3 rounded-3 px-3 w-100 open-video-module"
                            x-bind:class="{'d-flex': blob !== null}"
                            @click.prevent="uploadRecordedImage()"
                            x-show="blob !== null"
                            style="display: none"
                        >
                            <img src="{{ asset('v1.1/icons/upload-icon.svg') }}"  class="w-24" alt="">
                            <span class="ms-4">Click to Upload Photo</span>
                        </button>

                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 0; disposePlayer()">Back</a>
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 3">Next</a>
                        </div>
                    </div>
                    {{-- Media Type Upload Step: 2 --}}
                    <div class="py-3 w-full-md-50" x-show="mediaUploadType === 'upload' && mediaSettingWizard === 2">
                        <h4 class="text-primary-light fw-bold">Photo Upload</h4>
                        <div class="form-group my-5">
                            <div
                                x-data="{ isUploading{{ $stepSection->id }}MediaImage: false, progress{{ $stepSection->id }}MediaImage: 0 }"
                                x-on:livewire-upload-start="isUploading{{ $stepSection->id }}MediaImage = true"
                                x-on:livewire-upload-finish="isUploading{{ $stepSection->id }}MediaImage = false; @this.onChangeSectionMediaImageOrVideo('image'); isAlreadyUploaded = true"
                                x-on:livewire-upload-error="isUploading{{ $stepSection->id }}MediaImage = false"
                                x-on:livewire-upload-progress="progress{{ $stepSection->id }}MediaImage = $event.detail.progress"
                            >

                                <button
                                    class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center
                                align-items-center mb-3 rounded-3 px-3 w-100 open-cover-photo-module"
                                    @click.prevent="$refs.media{{ $stepSection->id }}Image.click()"
                                >
                                    <img src="{{asset('v1.1/icons/upload-icon.svg')}}"  class="w-24" alt="">
                                    <span class="ms-4">Upload cover photo</span>

                                </button>

                                @if(isset($mediaConfig['image']))
                                    <a
                                        href="{{ asset(isset($mediaConfig['image']) ? "storage/{$mediaConfig['image']}" : 'img/menu-icons/upload-img.svg') }}"
                                        title="Cover Photo"
                                        class="file-name-cover-photo text-primary-light"
                                        target="_blank"
                                    >
                                        <img
                                            src="{{ asset(isset($mediaConfig['image']) ? "storage/{$mediaConfig['image']}" : 'img/menu-icons/upload-img.svg') }}"
                                            class="img-thumbnail"
                                            alt=""
                                        /> <br /> Photo
                                    </a>
                                @endif

                                <x-input
                                    type="file"
                                    class="ChooseUploadImage py-1"
                                    id="media{{ $stepSection->id }}Image"
                                    x-ref="media{{ $stepSection->id }}Image"
                                    wire:model="stepSectionMediaImageOrVideo"
                                    class="d-none"
                                    style="height: 0px"
                                />
                                <div
                                    class="progress mt-2"
                                    x-show="isUploading{{ $stepSection->id }}MediaImage"
                                    style="height: 15px"
                                >
                                    <div
                                        class="progress-bar"
                                        role="progressbar"
                                        :style="`width: ${progress{{ $stepSection->id }}MediaImage}%`"
                                        x-on:aria-valuenow="progress{{ $stepSection->id }}MediaImage"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        x-text="`${progress{{ $stepSection->id }}MediaImage}%`"
                                    ></div>
                                </div>
                            </div>
                        </div>

                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 0">Back</a>
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 3">Next</a>
                        </div>
                    </div>

                    {{-- Video Title & Subtitle Step: 3 --}}
                    <div class="py-3 w-full-md-50" x-show="mediaSettingWizard === 3">
                        <div class="form-group mb-3">
                            <label for="" class="fs-20 fw-bold text-primary-light mb-1">Photo Title</label>
                            <x-input
                                type="text"
                                class="text-center fw-500 ph-lighter text-primary-light"
                                placeholder="Enter your photo title here"
                                wire:model.lazy="mediaConfig.title"
                                wire:change.debounce.500ms="onChangeMedia()"
                                wire:loading.attr="disabled"
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="fs-20 fw-bold text-primary-light mb-1">Photo Subtitle</label>
                            <x-input
                                type="text"
                                class="text-center fw-500 ph-lighter text-primary-light"
                                placeholder="Enter your photo subtitle here"
                                wire:model.lazy="mediaConfig.subtitle"
                                wire:change.debounce.500ms="onChangeMedia()"
                                wire:loading.attr="disabled"
                            />
                        </div>
                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 2">Back</a>
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 4">Next</a>
                        </div>
                    </div>

                    {{-- Video Setting Do you want to center your cover photo? Step: 4 --}}
                    <div class="py-3 w-full-md-50" x-show="mediaSettingWizard === 4">
                        <h4 class="text-primary-light fw-bold">Photo Settings</h4>
                        <div class="form-group my-5">
                            <p class="text-primary-light">Do you want to center your photo?</p>

                            <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                                <a href="#!" class="btn btn-primary-light{{ intVal($mediaConfig['image_center'] ?? 0) ? '' : 'er' }}-black-hover rounded py-2 px-4" @click.prevent="$wire.set('mediaConfig.image_center', '1', true); $wire.onChangeMedia()">Yes</a>
                                <a href="#!" class="btn btn-primary-light{{ intVal($mediaConfig['image_center'] ?? 0) ? 'er' : '' }}-black-hover rounded py-2 px-4" @click.prevent="$wire.set('mediaConfig.image_center', '0', true); $wire.onChangeMedia()">No</a>
                            </div>
                        </div>

                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 3">Back</a>
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 5">Next</a>
                        </div>
                    </div>
                    {{-- Video Setting Do you want to center your cover photo? Step: 5 --}}
                    <div class="py-3 w-full-md-50" x-show="mediaSettingWizard === 5">
                        <h4 class="text-primary-light fw-bold">Photo Settings</h4>
                        <div class="form-group my-5">
                            <p class="text-primary-light">Include background overlay on your photo?</p>

                            <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                                <a href="#!" class="btn btn-primary-light{{ intVal($mediaConfig['include_background_overlay'] ?? 0) ? '' : 'er' }}-black-hover rounded py-2 px-4" @click.prevent="$wire.set('mediaConfig.include_background_overlay', '1', true); $wire.onChangeMedia()">Yes</a>
                                <a href="#!" class="btn btn-primary-light{{ intVal($mediaConfig['include_background_overlay'] ?? 0) ? 'er' : '' }}-black-hover rounded py-2 px-4" @click.prevent="$wire.set('mediaConfig.include_background_overlay', '0', true); $wire.onChangeMedia()">No</a>
                            </div>
                        </div>

                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 4">Back</a>
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 6">Next</a>
                        </div>
                    </div>

                    {{-- Preview Step: 8 --}}
                    <div class="py-3" x-show="mediaSettingWizard === 6">
                        <h4 class="text-primary-light fw-bold">Photo Preview</h4>

                        <div
                            class="card border-0 rounded-15 shadow-sm py-3 image-module {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'max-size-img' : 'cover-img' }} "
                            style="background-image: url({{ asset(isset($mediaConfig['image']) ? "storage/{$mediaConfig['image']}" : 'img/dash/offer-forms/how-much-to-offer.png') }});
                                background-position: center;
                                background-repeat: no-repeat;height: 350px">

                            <div
                                class="{{ isset($mediaConfig['include_background_overlay']) && $mediaConfig['include_background_overlay'] === "1" ? 'card-img-overlay' : '' }}
                                    text-center text-white px-2 px-lg-5 d-flex align-items-center justify-content-center" style="height: 350px !important;">

                                <div
                                    class="{{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'img-fluid' : '' }}">
                                    <h3 class=" text-capitalize px-3 {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'fs-20' : '' }}">
                                        {{ $mediaConfig['title'] ?? 'Click here to edit this photo module' }}
                                    </h3>
                                    <a href="#!" class="text-white text-decoration-none fw-bold text-capitalize {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'fs-14' : '' }}">
                                        {{ $mediaConfig['subtitle'] ?? '' }}
                                    </a>
                                </div>

                            </div>

                        </div>

                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3 w-full-md-50">
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 5">Back</a>
                            <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaEdit = false; disposePlayer(); mediaSettingWizard = 0;">Done</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Footer of the Section [Start] --}}
            @if($routeIsEdit && $stepSection->type === 'medias')
                <hr/>
                <div class="d-flex align-items-center">
                    <ul class="list-group list-group-horizontal list-group-flush text-center rounded-3 ms-auto">
                        <li class="list-group-item border-0 bg-transparent">
                            <a href="#!" wire:click.prevent="duplicate()">
                                <div wire:loading wire:target="duplicate">
                                    <x-spinner/>
                                </div>
                                <img class="w-18" src="{{asset('img/dash/offer-forms/clone.svg')}}" alt=""
                                     wire:loading.remove wire:target="duplicate">
                            </a>
                        </li>
                        <li class="list-group-item border-0 bg-transparent">
                            <a href="#!"
                               data-bs-toggle="modal"
                               data-bs-target="#deleteConfirmation{{ $stepSection->id ?? 0 }}Modal"
                            >
                                <img class="w-16" src="{{asset('img/dash/offer-forms/delete-icon.svg')}}"
                                     alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
            {{-- Footer of the Section [End] --}}
        </div>
        {{-- Section Edit Area [End] --}}

        {{-- Section Preview Area [Start] --}}
        <div x-show="!mediaEdit" @click="mediaEdit = true">
            <div
                class="card border-0 rounded-15 shadow-sm py-3 image-module {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'max-size-img' : 'cover-img' }}"
                style="background-image: url({{ asset(isset($mediaConfig['image']) ? "storage/{$mediaConfig['image']}" : 'img/dash/offer-forms/how-much-to-offer.png') }});
                    background-position: center;
                    background-size: {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? '450px' : 'cover' }};
                    background-repeat: no-repeat;height: 350px">
                <div class="card-body text-center text-white px-2 px-lg-5 d-flex align-items-center justify-content-center
                    {{ isset($mediaConfig['include_background_overlay']) && $mediaConfig['include_background_overlay'] === "1" ? 'card-img-overlay' : '' }}
                    ">
                    <div
                        class="{{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'img-fluid' : '' }}">
                        <h3 class=" text-capitalize px-3 {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'fs-20' : '' }}">
                            {{ $mediaConfig['title'] ?? 'Click here to edit this photo module' }}  </h3>
                        <a href="#!"
                           class="text-white text-decoration-none fw-bold text-capitalize {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'fs-14' : '' }}">{{ $mediaConfig['subtitle'] ?? '' }}</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Section Preview Area [End] --}}
    </div>
@else
    <div
        class="card border-0 rounded-15 shadow-sm py-3 image-module {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'max-size-img' : 'cover-img' }} "
        style="background-image: url({{ asset(isset($mediaConfig['image']) ? "storage/{$mediaConfig['image']}" : 'img/dash/offer-forms/how-much-to-offer.png') }});
            background-position: center;
            background-repeat: no-repeat;height: 350px">

        <div
            class="{{ isset($mediaConfig['include_background_overlay']) && $mediaConfig['include_background_overlay'] === "1" ? 'card-img-overlay' : '' }}
                text-center text-white px-2 px-lg-5 d-flex align-items-center justify-content-center" style="height: 350px">

            <div
                class="{{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'img-fluid' : '' }}">
                <h3 class=" text-capitalize px-3 {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'fs-20' : '' }}">
                    {{ $mediaConfig['title'] ?? 'Click here to edit this photo module' }}
                </h3>
                <a href="#!" class="text-white text-decoration-none fw-bold text-capitalize
                        {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'fs-14' : '' }}">

                    {{ $mediaConfig['subtitle'] ?? '' }}

                </a>
            </div>

        </div>

    </div>

@endif

@push('scripts')

    <script type="text/javascript">

        $(function () {
            $('.uploadImgPath').on('change', function () {
                var filePath = $(this).val();
                console.log(filePath);
                var clean = filePath.split('\\').pop();
                $('.imgPathText').text(clean);
                console.log(clean);
            });
        });
    </script>

@endpush
