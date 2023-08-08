<form wire:submit.prevent="sendLink">
    <div
        class="modal hideableModal fade"
        wire:ignore.self
        id="sendFormBy{{ $by }}{{ $offerForm->id }}Modal"
        tabindex="-1"
        aria-labelledby="sendFormBy{{ $by }}{{ $offerForm->id }}ModalLabel"
        aria-hidden="true"

    >
        <div class="modal-dialog">
            <div  class="modal-content p-2">
                <div class="modal-header border-0 ms-auto pb-0">
                    <a
                        href=""
                        class="text-decoration-none"
                        data-bs-dismiss="modal" aria-label="Close"
                    >
                        <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                    </a>
                </div>

                <div class="modal-body text-email-popup">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body text-center">
                            <div
                                class="form-group mb-3"
                                x-init="
                                    googleMaps.load().then((google) => {
                                        var options = {
                                            componentRestrictions: { country: 'us' },
                                            fields: ['address_components', 'geometry'],
                                            types: ['address']
                                        };

                                        let autocomplete = new google.maps.places.Autocomplete(document.getElementById('propertyAddress{{ $by }}{{ $offerForm->id }}'), options);

                                        google.maps.event.addListener(autocomplete, 'place_changed', () => {
                                            $wire.set('propertyAddress', document.getElementById('propertyAddress{{ $by }}{{ $offerForm->id }}').value);

                                            var address = '';
                                            var zipcode = '';
                                            var country = '';
                                            var state = '';
                                            var city = '';

                                            let place = autocomplete.getPlace();

                                             // Get each component of the address from the place details,
                                            // and then fill-in the corresponding field on the form.
                                            // place.address_components are google.maps.GeocoderAddressComponent objects
                                            // which are documented at http://goo.gle/3l5i5Mr
                                            for (const component of place.address_components) {
                                                // @ts-ignore remove once typings fixed
                                                const componentType = component.types[0];

                                                switch (componentType) {
                                                    case 'street_number': {
                                                        break;
                                                    }
                                                    case 'route': {
                                                        break;
                                                    }
                                                    case 'postal_code': {
                                                        zipcode = component.long_name;
                                                        break;
                                                    }
                                                    case 'postal_code_suffix': {
                                                        break;
                                                    }
                                                    case 'locality':
                                                        city = component.long_name;
                                                        break;
                                                    case 'administrative_area_level_1': {
                                                        state = component.short_name;
                                                        break;
                                                    }
                                                    case 'country': {
                                                        country = component.long_name;
                                                        break;
                                                    }
                                                }
                                            }

                                            $wire.set('addressComponents', {city,state,country, zipcode}, true);
                                        });
                                    });
                                "
                            >
                                <label for="" class="fs-20 fw-bold text-primary-light mb-1">Enter Property Address</label>
                                <x-textarea
                                    wire:ignore
                                    class="text-center fw-500 ph-lighter text-primary-light auto-expand"
                                    name="propertyAddress"
                                    placeholder="Property Address"
                                    id="propertyAddress{{ $by }}{{ $offerForm->id }}"
                                    autocomplete="address-off"
                                    rows='1'
                                />

                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="fs-20 fw-bold text-primary-light mb-1">Enter Your Buyer's First Name</label>
                                <x-input type="text" class="text-center fw-500 ph-lighter text-primary-light" name="firstName" placeholder="Buyer First Name" wire:model.lazy="firstName"/>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="fs-20 fw-bold text-primary-light mb-1">Enter Your Buyer's Last Name</label>
                                <x-input type="text" class="text-center fw-500 ph-lighter text-primary-light" name="lastName" placeholder="Buyer Last Name" wire:model.lazy="lastName"/>
                            </div>
                            @if($by === 'Phone')
                                <div class="form-group mb-3" x-data>
                                    <label for="" class="fs-20 fw-bold text-primary-light mb-1" x-data>Enter Your Buyer's Phone Number</label>
                                    <x-input type="text" class="text-center fw-500 ph-lighter text-primary-light" name="phone" placeholder="Phone Number Here" wire:model.defer="phone" x-mask="{numericOnly: true, blocks: [0, 3, 3, 4], delimiters: ['(', ') ', '-']}"/>
                                </div>
                            @else
                                <div class="form-group mb-3">
                                    <label for="" class="fs-20 fw-bold text-primary-light mb-1">Enter Your Buyer's Email Address</label>
                                    <x-input type="email" class="text-center fw-500 ph-lighter text-primary-light autocomplete-email" name="email" placeholder="buyer@mail.com" wire:model.defer="email"/>
                                </div>
                            @endif
                            <div class="form-group mb-3 d-grid gap-2">
                                <a href="#"
                                   class="btn btn-lg text-uppercase btn-primary-light rounded-3"
                                   wire:click.prevent="$set('additionalBuyer', {{ !$additionalBuyer }})"
                                >
                                    CLick to {{ $additionalBuyer ? 'remove' : 'add' }} additional buyer
                                </a>
                            </div>
                            @if($additionalBuyer)
                                <div class="form-group mb-3">
                                    <label for="" class="fs-20 fw-bold text-primary-light mb-1">Enter Your Buyer's First Name</label>
                                    <x-input type="text" class="text-center fw-500 ph-lighter text-primary-light" name="additionalBuyerFirstName" placeholder="Buyer First Name" wire:model.lazy="additionalBuyerFirstName"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="fs-20 fw-bold text-primary-light mb-1">Enter Your Buyer's Last Name</label>
                                    <x-input type="text" class="text-center fw-500 ph-lighter text-primary-light" name="additionalBuyerLastName" placeholder="Buyer Last Name" wire:model.lazy="additionalBuyerLastName"/>
                                </div>
                            @endif
                            <div class="d-grid gap-2">
                                <a href="#"
                                   class="btn btn-lg text-uppercase btn-primary-light d-flex justify-content-between align-items-center rounded-3 px-3"
                                   wire:click.prevent="attachVideo"
                                >
                                    <img src="{{asset('v1.1/icons/attach-video-icon.svg')}}"  class="w-24" alt="">
                                    <div>
                                        <span wire:loading wire:target="video">Attaching...</span>
                                        <span wire:loading.remove wire:target="video">Attach Video</span>
                                    </div>
                                    <img src="{{asset('v1.1/icons/popover-white-icon.svg')}}"  class="w-24" alt=""
                                         data-bs-toggle="popover" data-bs-trigger="hover"
                                         data-bs-content="Record a personalized video to the top of the first page of your OfferForm"
                                         aria-hidden="true"
                                    >
                                </a>

                                @if($video)
                                    <p class="my-2 fs-10 text-dark fw-bold">Attached Video: {{$video->getClientOriginalName()}}</p>
                                @endif


                                <a href="#!"
                                    class="btn btn-lg text-uppercase btn-primary-light d-flex justify-content-between align-items-center rounded-3 px-3"
                                    wire:click.prevent="prefill"
                                >
                                    <img src="{{asset('v1.1/icons/pre-fill-icon.svg')}}"  class="w-24" alt="">
                                    <div>
                                        <span wire:loading wire:target="sendLink">Please wait...</span>
                                        <span wire:loading.remove wire:target="sendLink">Pre-Fill</span>
                                    </div>
                                    <img src="{{asset('v1.1/icons/popover-white-icon.svg')}}"  class="w-24" alt=""
                                         data-bs-toggle="popover" data-bs-trigger="hover"
                                         data-bs-content="Pre-fill as much info into the OfferForm as you'd like for your client"
                                         aria-hidden="true"
                                    >
                                </a>


                                <button
                                    class="btn btn-lg text-uppercase btn-primary-light text-center send-button-icon rounded-3 w-100 px-3"
                                    type="submit"
                                >
                                    <span wire:loading wire:target="sendLink">Sending...</span>
                                    <span wire:loading.remove wire:target="sendLink">Send</span>

                                </button>


                            </div>

                            <p class="fw-bold mt-5">A link to your OfferForm will be {{ $by === 'Phone' ? 'texted' : 'emailed' }} to your buyer </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Open Video Module Modal--}}
    <div
        class="modal fade hideableModal"
        id="openVideoModule{{ $by }}{{ $offerForm->id }}Modal"
        wire:ignore.self
        aria-hidden="true"
        aria-labelledby="openVideoModuleModalLabel"
        tabindex="-1"
        x-data="{
            videoType: null,
            isUploadingFile: false,
            uploadingProgress: 0,
            player: null,
            initPlayer() {
                console.log(window.videoJsOptions)
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
                });

                // user completed recording and stream is available
                this.player.on('finishRecord', () => {
                    // recordedData is a blob object containing the recorded data that
                    // can be downloaded by the user, stored on server etc.
                    console.log('finished recording: ', this.player.recordedData);

                    let blob = this.player.recordedData;
                    let file = new File([blob], blob.name,{type: blob.type, lastModified:new Date().getTime()}, 'utf-8');
                    let container = new DataTransfer();
                    container.items.add(file);
                    @this.upload('video', container.files[0], (uploadedFilename) => {
                            // Success callback.
                            console.log(uploadedFilename);
                        }, () => {
                            // Error callback.
                        }, (event) => {
                            console.log(event);
                            // Progress callback.
                            // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                        });
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
            }
        }"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 d-flex justify-content-between align-items-center  pb-0">
                    <a href="#" @click.prevent="videoType = null; disposePlayer(); @this.set('video', null);" x-show="videoType !== null" class="text-decoration-none fw-bold text-primary-light" style="display: none" x-transition.opacity>
                        <i class="fa fa-arrow-left me-1"></i>Back
                    </a>

                    <a href="#"
                       class="text-decoration-none ms-auto"
                       @click.prevent="disposePlayer(); $('#openVideoModule{{ $by }}{{ $offerForm->id }}Modal').modal('hide');@this.set('video', null);videoType = null;"
{{--                       data-bs-dismiss="modal" aria-label="Close"--}}
                    >
                        <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                    </a>

                </div>
                <div class="modal-body">
                    <p class="text-center">This will attach a custom video on the first step of the OfferForm. </p>
                    <div class="w-full-md-75 my-3 d-grid">
                        <div x-show="videoType === null">
                            <x-button
                                class="text-uppercase btn-primary-light d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100"
                                @click.prevent="videoType = 'record'; initPlayer()"
                            >
                                <img src="{{asset('v1.1/icons/record-icon.svg')}}"  class="w-24" alt="">
                                <span class="ms-4">Record Video</span>
                            </x-button>
                            <x-button
                                class="text-uppercase btn-primary-light d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100"
                                @click.prevent="videoType = 'upload'"
                            >
                                <img src="{{asset('v1.1/icons/upload-icon.svg')}}"  class="w-24" alt="">
                                <span class="ms-4">Upload Video</span>
                            </x-button>
                            <x-button
                                class="text-uppercase btn-primary-light d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100"
                                @click.prevent="videoType = 'youtube'"
                            >
                                <img src="{{asset('v1.1/icons/youtube-icon.svg')}}"  class="w-24" alt="">
                                <span class="ms-4">Youtube Link</span>
                            </x-button>
                        </div>
                        <div
                            x-show="videoType === 'record'"
                            style="display: none" class="mb-3"
                        >
                            <div wire:ignore>
                                <video x-ref="video_player" playsinline class="video-js vjs-default-skin rounded"></video>
                            </div>
                            @if($video)
                                Recorded "{{ $video->getClientOriginalName() }}" click send to upload and send.
                            @endif
                        </div>
                        <div x-show="videoType === 'upload'" style="display: none" class="mb-3">
                            <div class="text-start"
                                 x-on:livewire-upload-start="isUploadingFile = true"
                                 x-on:livewire-upload-finish="isUploadingFile = false;"
                                 x-on:livewire-upload-error="isUploadingFile = false"
                                 x-on:livewire-upload-progress="uploadingProgress = $event.detail.progress"
                            >
                                <x-input
                                    id="upload_vide_{{ $by }}{{ $offerForm->id }}"
                                    type="file"
                                    hidden="hidden"
                                    wire:model="video"
                                />
                                <div class="progress my-2" x-show="isUploadingFile"
                                     style="height: 15px; display: none">
                                    <div class="progress-bar" role="progressbar" :style="`width: ${uploadingProgress}%`"
                                         x-on:aria-valuenow="uploadingProgress" aria-valuemin="0" aria-valuemax="100"
                                         x-text="`${uploadingProgress}%`"></div>
                                </div>
                            </div>

                            <button
                                type="button"
                                id="custom-button"
                                class="btn btn-primary-light rounded-3 px-3 text-white"
                                onclick='document.getElementById("upload_vide_{{ $by }}{{ $offerForm->id }}").click()'
                            >
                                Choose Video
                            </button>

                            <span class="ms-3 fw-500">
                                @if($video)
                                    {{ $video->getClientOriginalName() }}
                                @else
                                    No video file chosen
                                @endif
                            </span>
                        </div>
                        <div x-show="videoType === 'youtube'" style="display: none" class="mb-3">
                            <div class="form-group mb-3">
                                <label for="" class="fs-20 fw-bold text-primary-light mb-1">Youtube Link:</label>
                                <x-input type="url" class="text-center fw-500 ph-lighter text-primary-light" name="youtube" placeholder="" wire:model.lazy="youtube"/>
                            </div>
                        </div>



                        <div x-show="videoType !== null" style="display: none">


                            <a href="#!"
                               class="btn btn-lg text-uppercase btn-primary-light d-flex justify-content-between align-items-center rounded-3 px-3 mb-3"
                               wire:click.prevent="prefill"
                            >
                                <img src="{{asset('v1.1/icons/pre-fill-icon.svg')}}"  class="w-24" alt="">
                                <div>
                                    <span wire:loading wire:target="sendLink">Please wait...</span>
                                    <span wire:loading.remove wire:target="sendLink">Attach &amp; Pre-Fill</span>
                                </div>
                                <img src="{{asset('v1.1/icons/popover-white-icon.svg')}}"  class="w-24" alt=""
                                     data-bs-toggle="popover" data-bs-trigger="hover"
                                     data-bs-content="Pre-fill as much info into the OfferForm as you'd like for your client"
                                     aria-hidden="true"
                                >
                            </a>

                            <x-button
                                class="text-uppercase btn-primary-light  text-center send-button-icon mb-3 rounded-3 px-3 w-100"
                                type="submit"
                            >
                                <span wire:loading wire:target="sendLink">Sending...</span>
                                <span wire:loading.remove wire:target="sendLink">Send</span>
                            </x-button>
                        </div>
                        <a href="#"
                           @click="disposePlayer(); videoType = null; disposePlayer(); @this.set('video', null);"
                           class="btn btn-lg text-uppercase btn-primary-light d-flex justify-content-center align-items-center mb-3 rounded-3 px-3 w-100"
                           data-bs-target="#sendFormBy{{ $by }}{{ $offerForm->id }}Modal" data-bs-toggle="modal" data-bs-dismiss="modal"
                        >
                            Back
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</form>




@once
    @push('scripts')
        <script>
            $(function () {
                window.livewire.on('send-modal-attach-video', function (id) {
                    $('.hideableModal').modal('hide');
                    $(`#openVideoModule${id}Modal`).modal('show');
                })
            });
        </script>
    @endpush
@endonce
