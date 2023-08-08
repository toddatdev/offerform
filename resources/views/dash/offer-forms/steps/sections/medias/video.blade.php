@push('stylesheets')
    <style>
        @media (max-width: 768px) {
            .how-much-to-offer-video-link {
                height: 330px !important;
            }
        }

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

        .customInput:checked[type=radio] {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjMiIGhlaWdodD0iNTkiIHZpZXdCb3g9IjAgMCA2MyA1OSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGVsbGlwc2UgY3g9IjMxLjA1MjgiIGN5PSIyOS4zODczIiByeD0iMzEuMDUyOCIgcnk9IjI5LjM4NzMiIGZpbGw9IiM5QzRFREQiLz4KPC9zdmc+Cg==) !important;
        }

        .customInput:checked {
            background-color: #9C4EDD;
            border-color: #9C4EDD;
            width: 18px !important;
            height: 18px !important;
        }
    </style>
@endpush
@php
    $bg = asset('img/dash/offer-forms/how-much-to-offer.png');
    $vid = null;
    $id = isset($stepSection) ? $stepSection->id : 0;

    if (!isset($mediaConfig['video']) && isset($mediaConfig['youtube']) && $thumbnailUrl = youtube_video_thumbnail($mediaConfig['youtube'])) {
        $bg = $thumbnailUrl;
        $vid = youtube_video_id_from_url($mediaConfig['youtube']);
    } elseif (isset($mediaConfig['video']) && Storage::disk('public')->exists($mediaConfig['video']) && Storage::disk('public')->exists(str_replace('.mp4', '.png', $mediaConfig['video']))) {
        $bg = Storage::disk('public')->url(str_replace('.mp4', '.png', $mediaConfig['video']));
    }

    if(isset($mediaConfig['image']) && Storage::disk('public')->exists($mediaConfig['image'])) {
        $bg = Storage::disk('public')->url($mediaConfig['image']);
    }
@endphp
@if($routeIsEdit)
    <div
        x-data="{
            mediaEdit: false,
            videoUrl: '',
            mediaSettingWizard: 0,
            mediaUploadType: '{{ isset($mediaConfig['video']) ? 'upload' : (isset($mediaConfig['youtube']) ? 'youtube' : '') }}',
            isAlreadyUploaded: !!{{ isset($mediaConfig['video']) || isset($mediaConfig['youtube']) ? 1 : 0}},
            wantToIncludeCoverPhoto: !!{{ isset($mediaConfig['image']) ? 1 : 0}},
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
                this.player = videojs($refs.video_player, window.videoJsOptions, () => {
                    // print version information at startup
                    const version_info = 'Using video.js ' + videojs.VERSION +
                        ' with videojs-record ' + videojs.getPluginVersion('record') +
                        ' and recordrtc ' + RecordRTC.version;
                    videojs.log(version_info);
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
            uploadRecordedVideo() {
                this.isRecordUploading = true;
                let file = new File([this.blob], this.blob.name,{type: this.blob.type, lastModified:new Date().getTime()}, 'utf-8');
                let container = new DataTransfer();
                container.items.add(file);
                @this.upload('stepSectionMediaImageOrVideo', container.files[0], (uploadedFilename) => {
                        // Success callback.
                        @this.onChangeSectionMediaImageOrVideo('video');
                        this.isRecordUploading = false;
                        this.recordUploadProgress = 0;
                        this.blob = null;
                        @this.emit('showToast', 'Success!', 'Recording uploaded and saved successfully.');
                    }, () => {
                        @this.emit('showToast', 'Error!', 'Unable to upload your video please try again.', 1);
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
        x-transition
        style="min-height: 350px; transition: height 4s"
    >
        {{-- Section Edit Area [Start] --}}
        <div
            x-show="mediaEdit"
            @click.away="mediaEdit = false; disposePlayer(); mediaSettingWizard = 0; "
            style="display: none;"
            class="p-4"
        >
            <div style="min-height: 400px" class="p-4 position-relative">
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
                    <p class="text-center mt-4">This will attach a custom video on the first step of the OfferForm.</p>
                    <div class="w-full-md-50 py-3 my-3 px-3 px-lg-5">
                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center align-items-center mb-4 rounded-3 px-3 w-100"
                            @click.prevent="mediaSettingWizard = 1"
                        >
                            <img src="{{asset('v1.1/icons/plus-white-icon.svg')}}"  class="w-24" alt="">
                            <span class="ms-4">Add New Video</span>

                        </a>

                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover  justify-content-center align-items-center mb-4 rounded-3 px-3 w-100"
                            @click.prevent="mediaSettingWizard = 2"
                            :class="{'d-flex': isAlreadyUploaded }"
                            x-show="mediaUploadType === 'upload' || mediaUploadType === 'record' || mediaUploadType === 'youtube'"
                        >
                            <img src="{{ asset('v1.1/icons/edit-white-pencil-icon.svg') }}"  class="w-24" alt="">
                            <span class="ms-4">Edit Current Video</span>

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
                            @click.prevent="mediaUploadType = 'record'; mediaSettingWizard = 2; initPlayer()"
                        >
                            <img src="{{asset('v1.1/icons/record-icon.svg')}}"  class="w-24" alt="">
                            <span class="ms-4">Record Video</span>

                        </a>

                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100"
                            @click.prevent="mediaUploadType = 'upload'; mediaSettingWizard = 2"
                        >
                            <img src="{{asset('v1.1/icons/upload-icon.svg')}}"  class="w-24" alt="">
                            <span class="ms-4">Upload Video</span>

                        </a>

                        <a href="#!"
                            class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100"
                            @click.prevent="mediaUploadType = 'youtube'; mediaSettingWizard = 2"
                        >
                            <img src="{{asset('v1.1/icons/youtube-icon.svg')}}"  class="w-24" alt="">
                            <span class="ms-4">Youtube Link</span>
                        </a>

                    </div>
                </div>

                {{-- Step: 3 --}}
                <div x-show="mediaSettingWizard >= 2">
                {{-- Media Type Record Step: 2 --}}
                <div class=" w-full-md-75 py-3" x-show="mediaUploadType === 'record' && mediaSettingWizard === 2">
                    <div wire:ignore class="recordVideoModule">
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
                        @click.prevent="uploadRecordedVideo()"
                        x-show="blob !== null"
                        style="display: none"
                    >
                        <img src="{{ asset('v1.1/icons/upload-icon.svg') }}"  class="w-24" alt="">
                        <span class="ms-4">Click to Upload Video</span>
                    </button>

                    <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 0; disposePlayer()">Back</a>
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 3">Next</a>
                    </div>
                </div>
                {{-- Media Type Upload Step: 2 --}}
                <div class="py-3 w-full-md-50" x-show="mediaUploadType === 'upload' && mediaSettingWizard === 2">
                    <h4 class="text-primary-light fw-bold">Video Upload</h4>
                    <div class="form-group my-5">
                        <div x-data="{ isUploading{{ $stepSection->id }}Video: false, progress{{ $stepSection->id }}Video: 0 }"
                             x-on:livewire-upload-start="isUploading{{ $stepSection->id }}Video = true"
                             x-on:livewire-upload-finish="isUploading{{ $stepSection->id }}Video = false; @this.onChangeSectionMediaImageOrVideo('video')"
                             x-on:livewire-upload-error="isUploading{{ $stepSection->id }}Video = false"
                             x-on:livewire-upload-progress="progress{{ $stepSection->id }}Video = $event.detail.progress"
                        >
                            <button
                                class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100 open-video-module"
                                @click.prevent="$refs.media{{ $stepSection->id }}Video.click()"
                            >
                                <img src="{{ asset('v1.1/icons/upload-icon.svg') }}"  class="w-24" alt="">
                                <span class="ms-4">Click to Upload Video</span>
                            </button>
                            @if(isset($mediaConfig['video']))
                                <a
                                    href="{{ asset(isset($mediaConfig['video']) ? "storage/{$mediaConfig['video']}" : '#') }}"
                                    title="Uploaded Video"
                                    class="file-name text-primary-light"
                                    target="_blank"
                                >
                                    <img src="{{asset('img/menu-icons/upload-img.svg')}}" class="w-28" alt=""> Uploaded Video
                                </a>
                            @endif
                            <div class="progress mt-2" x-show="isUploading{{ $stepSection->id }}Video" style="height: 15px">
                                <div class="progress-bar" role="progressbar"
                                     :style="`width: ${progress{{ $stepSection->id }}Video}%`"
                                     x-on:aria-valuenow="progress{{ $stepSection->id }}Video" aria-valuemin="0"
                                     aria-valuemax="100" x-text="`${progress{{ $stepSection->id }}Video}%`"></div>
                            </div>
                            <x-input
                                type="file"
                                name="stepSectionMediaImageOrVideo"
                                id="media{{ $stepSection->id }}Video"
                                x-ref="media{{ $stepSection->id }}Video"
                                wire:model="stepSectionMediaImageOrVideo"
                                class="d-none uploadImgPath" style="height: 0px"
                            />
                        </div>
                    </div>

                    <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 0">Back</a>
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 3">Next</a>
                    </div>
                </div>
                {{-- Media Type Youtube Step: 2 --}}
                <div class="py-3 w-full-md-50" x-show="mediaUploadType === 'youtube' && mediaSettingWizard === 2">
                    <h4 class="text-primary-light fw-bold">YouTube Link</h4>
                    <div class="form-group my-5">
                        <img src="{{asset('v1.1/icons/youtube-primary-icon.svg')}}" class="mb-2" width="60" alt="">
                        <x-input
                            wire:model.lazy="mediaConfig.youtube"
                            wire:change.debounce.500ms="onChangeSectionMediaImageOrVideo('video', 'remove')"
                            class="text-primary-light text-center ph-lighter" placeholder="Enter your YouTube video link here"
                            wire:loading.attr="disabled"
                        />
                    </div>

                    <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 0">Back</a>
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 3">Next</a>
                    </div>
                </div>

                {{-- Video Title & Subtitle Step: 3 --}}
                <div class="py-3 w-full-md-50" x-show="mediaSettingWizard === 3">
                    <div class="form-group mb-3">
                        <label for="" class="fs-20 fw-bold text-primary-light mb-1">Video Title</label>
                        <x-input
                            type="text"
                            class="text-center fw-500 ph-lighter text-primary-light"
                            name="lastName"
                            placeholder="Enter your video title here"
                            wire:model.lazy="mediaConfig.title"
                            wire:change.debounce.500ms="onChangeMedia()"
                            wire:loading.attr="disabled"
                        />
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="fs-20 fw-bold text-primary-light mb-1">Video Subtitle</label>
                        <x-input
                            type="text"
                            class="text-center fw-500 ph-lighter text-primary-light"
                            name="lastName"
                            placeholder="Enter your video subtitle here"
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

                {{-- Video Setting Include Cover Photo for Video Step: 4 --}}
                <div class="py-3 w-full-md-50" x-show="mediaSettingWizard === 4">
                    <h4 class="text-primary-light fw-bold">Video Settings</h4>
                    <div class="form-group my-5">
                        <p class="text-primary-light">Do you want to include a cover photo for you video?</p>

                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                            <a href="#!"
                                class="btn rounded py-2 px-4"
                                :class="{'btn-primary-light-black-hover': wantToIncludeCoverPhoto, 'btn-primary-lighter-black-hover': !wantToIncludeCoverPhoto} "
                                @click.prevent="wantToIncludeCoverPhoto = true"
                            >
                                Yes
                            </a>
                            <a href="#!"
                                class="btn btn-primary-light-black-hover rounded py-2 px-4"
                                :class="{'btn-primary-lighter-black-hover': wantToIncludeCoverPhoto, 'btn-primary-light-black-hover': !wantToIncludeCoverPhoto} "
                                @click.prevent="wantToIncludeCoverPhoto = false"
                            >
                                No
                            </a>
                        </div>
                    </div>

                    <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 3">Back</a>
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = wantToIncludeCoverPhoto ? 5 : 8">Next</a>
                    </div>
                </div>
                {{-- Video Setting Upload Cover Photo for Video Step: 5 --}}
                <div class="py-3 w-full-md-50" x-show="mediaSettingWizard === 5">
                    <h4 class="text-primary-light fw-bold">Video Settings</h4>
                    <div class="form-group my-5">
                        <div
                            x-data="{ isUploading{{ $stepSection->id }}MediaImage: false, progress{{ $stepSection->id }}MediaImage: 0 }"
                            x-on:livewire-upload-start="isUploading{{ $stepSection->id }}MediaImage = true"
                            x-on:livewire-upload-finish="isUploading{{ $stepSection->id }}MediaImage = false; @this.onChangeSectionMediaImageOrVideo('image')"
                            x-on:livewire-upload-error="isUploading{{ $stepSection->id }}MediaImage = false"
                            x-on:livewire-upload-progress="progress{{ $stepSection->id }}MediaImage = $event.detail.progress"
                        >

                            <button
                                class="btn btn-lg capitalize btn-primary-light-black-hover d-flex justify-content-center
                            align-items-center mb-3 rounded-3 px-3 w-100 open-cover-photo-module"
                                @click.prevent="$refs.media{{ $stepSection->id }}VideoImage.click()"
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
                                        class=""
                                        style="width: 200px !important;"
                                        alt=""
                                    /> <br /> Cover Photo
                                </a>
                            @endif

                            <x-input
                                type="file"
                                class="ChooseUploadImage py-1"
                                id="media{{ $stepSection->id }}VideoImage"
                                x-ref="media{{ $stepSection->id }}VideoImage"
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
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 4">Back</a>
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 6">Next</a>
                    </div>
                </div>
                {{-- Video Setting Do you want to center your cover photo? Step: 6 --}}
                <div class="py-3 w-full-md-50" x-show="mediaSettingWizard === 6">
                    <h4 class="text-primary-light fw-bold">Video Settings</h4>
                    <div class="form-group my-5">
                        <p class="text-primary-light">Do you want to center your cover photo?</p>

                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                            <a href="#!" class="btn btn-primary-light{{ intVal($mediaConfig['image_center'] ?? 0) ? '' : 'er' }}-black-hover rounded py-2 px-4" @click.prevent="$wire.set('mediaConfig.image_center', '1', true); $wire.onChangeMedia()">Yes</a>
                            <a href="#!" class="btn btn-primary-light{{ intVal($mediaConfig['image_center'] ?? 0) ? 'er' : '' }}-black-hover rounded py-2 px-4" @click.prevent="$wire.set('mediaConfig.image_center', '0', true); $wire.onChangeMedia()">No</a>
                        </div>
                    </div>

                    <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 5">Back</a>
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 7">Next</a>
                    </div>
                </div>
                {{-- Video Setting Do you want to center your cover photo? Step: 7 --}}
                <div class="py-3 w-full-md-50" x-show="mediaSettingWizard === 7">
                    <h4 class="text-primary-light fw-bold">Video Settings</h4>
                    <div class="form-group my-5">
                        <p class="text-primary-light">Include background overlay on your cover photo?</p>

                        <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                            <a href="#!" class="btn btn-primary-light{{ intVal($mediaConfig['include_background_overlay'] ?? 0) ? '' : 'er' }}-black-hover rounded py-2 px-4" @click.prevent="$wire.set('mediaConfig.include_background_overlay', '1', true); $wire.onChangeMedia()">Yes</a>
                            <a href="#!" class="btn btn-primary-light{{ intVal($mediaConfig['include_background_overlay'] ?? 0) ? 'er' : '' }}-black-hover rounded py-2 px-4" @click.prevent="$wire.set('mediaConfig.include_background_overlay', '0', true); $wire.onChangeMedia()">No</a>
                        </div>
                    </div>

                    <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3">
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 6">Back</a>
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = 8">Next</a>
                    </div>
                </div>

                {{-- Preview Step: 8 --}}
                <div class="py-3" x-show="mediaSettingWizard === 8">
                    <h4 class="text-primary-light fw-bold">Video Settings</h4>

                    <div
                        x-data="{
        videoUrl: '{{ video_url($mediaConfig['video'] ?? $mediaConfig['youtube'] ?? '') }}',
        thumbnailUrl: '{{$bg}}',
        playableUrl: '{{$bg}}',
        isPlaying: false,
        ytPlayer: null,
        playOrPauseVideo() {
            if(this.isPlaying) {
                this.isPlaying = false;
                this.playableUrl = this.thumbnailUrl;
                if (this.ytPlayer !== null) this.ytPlayer.pause();
                else $refs.local_{{$id}}.pause();
            } else {
                this.playableUrl = this.videoUrl;
                this.isPlaying = true;

                if (this.ytPlayer !== null) {
                    this.ytPlayer.load('{{ $vid }}', true);
                } else $refs.local_{{$id}}.play();
            }
        }
    }"
                        x-init="
        @if(!is_null($vid))
                            ytPlayer = new YTPlayer('#yt{{$id}}player', {
                autoplay: true,
            });
        @endif
                            "
                        {{--    @click.away="isPlaying ? $dispatch('toggle-paying-{{ $stepSection->id }}') : ''"--}}
                    >
                        <div class="card border-0 rounded-15 shadow-sm py-3"
                             style="background-image: url('{{ $bg }}');
                                 background-position: {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'center' : 'left top' }};
                                 background-size: cover; background-repeat: no-repeat;height: 350px"
                             :class="{'py-3': !isPlaying, 'p-0': isPlaying}"

                        >
                            <div
                                class="{{ isset($mediaConfig['include_background_overlay']) && $mediaConfig['include_background_overlay'] === "1" ? 'card-img-overlay' : '' }}
                                    card-body text-center text-white  align-self-center align-items-center justify-content-center"
                                :class="{'d-flex': !isPlaying, 'd-none': isPlaying}">
                                <div>
                                    <h2 class="text-capitalize">{{ $mediaConfig['title'] ?? '' }}</h2>
                                    <div class="my-3">
                                        <a href="#"
                                           x-on:click.prevent="videoUrl !== '' && videoUrl !== '{{ asset('storage')}}' ? playOrPauseVideo() : ''"
                                        >
                                            <i class="fa fa-play bg-white p-4 fs-20 rounded-circle text-primary shadow"></i>
                                        </a>
                                    </div>
                                    <a href="javascript:void(0)"
                                       class="text-white text-decoration-none fw-500 text-capitalize">
                                        {{ $mediaConfig['subtitle'] ?? 'Click Play to learn more' }}
                                    </a>
                                </div>
                            </div>
                            <div class="rounded-15 bg-white" style="display: none; height: 350px" x-show="isPlaying">
                                @if(!is_null($vid))
                                    <div class="w-100 rounded-15" id="yt{{$id}}player"></div>
                                @else
                                    <video class="rounded-15" controls width="100%" height="350" x-ref="local_{{$id}}"

                                    >
                                        <source src="{{ video_url($mediaConfig['video'] ?? $mediaConfig['youtube'] ?? '') }}" type="video/mp4" />
                                        Your browser does not support HTML video.
                                    </video>
                                    {{--                <iframe class="w-100 rounded-15" frameborder="0" allowfullscreen="1" id="clickForMoreInfo"--}}
                                    {{--                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                                    {{--                        height="350"--}}
                                    {{--                        :src="`${playableUrl}?autoplay=1`">--}}
                                    {{--                </iframe>--}}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="btn-group gap-2 gap-lg-4 mt-4 mb-3 w-full-md-50">
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaSettingWizard = wantToIncludeCoverPhoto ? 7 : 4">Back</a>
                        <a href="#!" class="btn btn-primary-light-black-hover rounded py-2 w-210 px-5" @click.prevent="mediaEdit = false; disposePlayer(); mediaSettingWizard = 0; ">Done</a>
                    </div>
                </div>
            </div>
            </div>
            {{-- Footer of the Section [Start] --}}
            @if($routeIsEdit && $stepSection->type === 'medias')
                <hr/>
                <div class="d-flex">
                    <ul class="list-group list-group-horizontal list-group-flush text-center rounded-3 ms-auto">
                        <li class="list-group-item border-0 bg-transparent">
                            <a href="#" wire:click.prevent="duplicate()">
                                <div wire:loading wire:target="duplicate">
                                    <x-spinner/>
                                </div>
                                <img class="w-18" src="{{asset('img/dash/offer-forms/clone.svg')}}" alt=""
                                     wire:loading.remove wire:target="duplicate">
                            </a>
                        </li>
                        <li class="list-group-item border-0 bg-transparent">
                            <a href="#"
                               data-bs-toggle="modal"
                               data-bs-target="#deleteConfirmation{{ $stepSection->id ?? 0 }}Modal"
                            >
                                <img
                                    class="w-16" src="{{asset('img/dash/offer-forms/delete-icon.svg')}}"
                                    alt=""
                                />
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
            {{-- Footer of the Section [End] --}}
        </div>
        {{-- Section Edit Area [End] --}}

        @php
            $url = video_url($mediaConfig['video'] ?? $mediaConfig['youtube'] ?? '#');
        @endphp
        {{-- Section Preview Area [Start] --}}
        <div x-show="!mediaEdit" @click="mediaEdit= true">
            <div class="card border-0 rounded-15 shadow-sm {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'max-size-img' : 'cover-img' }}"
                 style="background-image: url({{ $bg }});
                     background-position: center;background-size: cover;background-repeat: no-repeat; height: 350px">
                <div class="card-body text-center text-white px-2 px-lg-5 py-5 align-self-center d-flex align-items-center justify-content-center
                {{ isset($mediaConfig['include_background_overlay']) && $mediaConfig['include_background_overlay'] === "1" ? 'card-img-overlay' : '' }}">
                    <div class="">
                        <h2 class="">{{ $mediaConfig['title'] ?? 'Click here to upload your custom video' }}</h2>

                        <div class="my-3">
                            <a href="javascript:void(0)"
                               @if($url !== '#' && $url !== asset('storage/#'))
                               data-bs-toggle="modal"
                               onclick="event.stopPropagation()"
                               data-bs-target="#previewVideoInEditMode"
                               @endif
                               id="media{{$stepSection->id}}VideoPreviewModal"
                               data-video-link="{{ video_url($mediaConfig['video'] ?? $mediaConfig['youtube'] ?? '#') }}?autoplay=1"
                            >
                                <i class="fa fa-play bg-white p-4 fs-20 rounded-circle text-primary shadow"></i>
                            </a>
                        </div>

                        <a href="#"
                           onclick="event.stopPropagation()"
                           class="text-white text-decoration-none fw-500">{{ $mediaConfig['subtitle'] ?? 'Click Play to learn more' }}</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Section Preview Area [End] --}}
    </div>
@else

    <div
        x-data="{
        videoUrl: '{{ video_url($mediaConfig['video'] ?? $mediaConfig['youtube'] ?? '') }}',
        thumbnailUrl: '{{$bg}}',
        playableUrl: '{{$bg}}',
        isPlaying: false,
        ytPlayer: null,
        playOrPauseVideo() {
            if(this.isPlaying) {
                this.isPlaying = false;
                this.playableUrl = this.thumbnailUrl;
                if (this.ytPlayer !== null) this.ytPlayer.pause();
                else $refs.local_{{$id}}.pause();
            } else {
                this.playableUrl = this.videoUrl;
                this.isPlaying = true;

                if (this.ytPlayer !== null) {
                    this.ytPlayer.load('{{ $vid }}', true);
                } else $refs.local_{{$id}}.play();
            }
        }
    }"
        x-init="
        @if(!is_null($vid))
            ytPlayer = new YTPlayer('#yt{{$id}}player', {
                autoplay: true,
            });
        @endif
            "
        {{--    @click.away="isPlaying ? $dispatch('toggle-paying-{{ $stepSection->id }}') : ''"--}}
    >
        <div class="card border-0 rounded-15 shadow-sm py-3 {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'max-size-img' : 'cover-img' }}"
             style="background-image: url('{{ $bg }}');
                 background-position: {{ isset($mediaConfig['image_center']) && $mediaConfig['image_center'] === "1" ? 'center' : 'left top' }};
                 background-size: cover; background-repeat: no-repeat;height: 350px"
             :class="{'py-3': !isPlaying, 'p-0': isPlaying}"

        >
            <div
                class="{{ isset($mediaConfig['include_background_overlay']) && $mediaConfig['include_background_overlay'] === "1" ? 'card-img-overlay' : '' }}
                    card-body text-center text-white  align-self-center align-items-center justify-content-center"
                :class="{'d-flex': !isPlaying, 'd-none': isPlaying}">
                <div>
                    <h2 class="text-capitalize">{{ $mediaConfig['title'] ?? '' }}</h2>
                    <div class="my-3">
                        <a href="#"
                           x-on:click.prevent="videoUrl !== '' && videoUrl !== '{{ asset('storage')}}' ? playOrPauseVideo() : ''"
                        >
                            <i class="fa fa-play bg-white p-4 fs-20 rounded-circle text-primary shadow"></i>
                        </a>
                    </div>
                    <a href="javascript:void(0)"
                       class="text-white text-decoration-none fw-500 text-capitalize">
                        {{ $mediaConfig['subtitle'] ?? 'Click Play to learn more' }}
                    </a>
                </div>
            </div>
            <div class="rounded-15 bg-white" style="display: none; height: 350px" x-show="isPlaying">
                @if(!is_null($vid))
                    <div class="w-100 rounded-15" id="yt{{$id}}player"></div>
                @else
                    <video class="rounded-15" controls width="100%" height="350" x-ref="local_{{$id}}"

                    >
                        <source src="{{ video_url($mediaConfig['video'] ?? $mediaConfig['youtube'] ?? '') }}" type="video/mp4" />
                        Your browser does not support HTML video.
                    </video>
                    {{--                <iframe class="w-100 rounded-15" frameborder="0" allowfullscreen="1" id="clickForMoreInfo"--}}
                    {{--                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                    {{--                        height="350"--}}
                    {{--                        :src="`${playableUrl}?autoplay=1`">--}}
                    {{--                </iframe>--}}
                @endif
            </div>
        </div>
    </div>
@endif



@push('scripts')

@endpush
