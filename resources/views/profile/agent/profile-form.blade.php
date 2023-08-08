<div>
    {{--Start Popover--}}

    <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
            data-bs-container="body"
            data-bs-toggle="popover"
            data-bs-html="true"
       data-bs-content="<p>The setup guild will walk you through...</p>
               <br/><a href='#' class='openModalSetupForm text-decoration-none text-dark'
               >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
       aria-hidden="true">
    </button>


    <!-- Modal -->
    <div class="modal fade" id="offerFormSetupGuide" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header border-0 text-center">
                    <button type="button"
                            class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12"
                            data-bs-dismiss="modal" aria-label="Close">X
                    </button>
                </div>

                <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                >
                    <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                    <p class="text-primary-light fw-500">
                        The setup guild will walk you through how to set up your account and use OfferForm.

                    </p>

                    <div class="first-time-user-popup-video">
                        <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                               controls>
                            <source src="{{asset('video/first-time-user-popup/first-time-user-popup.mp4')}}"
                                    type="video/mp4">
                        </video>
                    </div>

                </div>


            </div>
        </div>
    </div>

    {{--End Popover--}}

    <form wire:submit.prevent="updateProfileInformation" class="card border-0 mb-4 shadow-sm p-3">
        <div class="card-body">
            <h4 class="fw-bold text-primary-light">Edit Profile</h4>
            <hr>
            <div class="row mb-3 mt-4">
                <div class="col-12 col-lg-4">
                    <x-profile-photo wire:model="photo" :user="$user"/>
                    {{--  Video link--}}
                    <div class="mb-3">
                        <h5 class="fw-bold mb-3">Your introduction Video
                            <a href=""
                               data-bs-toggle="modal"
                               data-bs-target="#setupGuide">
                                <i href="#"
                                   class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2"
                                   data-bs-toggle="popover"
                                   data-bs-trigger="hover"
                                   data-bs-content="The setup guild will walk you through how to set up your account and use OfferForm."
                                   aria-hidden="true">
                                </i>
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="setupGuide" data-bs-backdrop="static" data-bs-keyboard="false"
                                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" style="max-width: 600px;">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 text-center">
                                            <button type="button"
                                                    class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12"
                                                    data-bs-dismiss="modal" aria-label="Close">X
                                            </button>
                                        </div>
                                        <div class="modal-body firstTimeSetupChecklist px-3 mt-1">
                                            <div class="first-time-user-popup-video">
                                                <video width="100%" height="320"
                                                       class="stopVideoOnModalHide rounded-3 object-cover" controls>
                                                    <source
                                                        src="{{asset('video/first-time-user-popup/first-time-user-popup.mp4')}}"
                                                        type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </h5>

                        @php

                            $videoUrl = null;
                            $isYoutube = false;
                            if($video && $video->getClientOriginalExtension() === 'mp4') {
                               $videoUrl = $video->temporaryUrl();
                            } elseif(isset($this->state['video_url']) && $this->state['video_url'] !== '') {
                                $videoUrl = video_url($this->state['video_url']) . '?autoplay=0';
                                $isYoutube = true;
                            } elseif ($this->user->video) {
                                $videoUrl = video_url($this->user->video);
                            }

                        @endphp

                        @if(is_null($videoUrl))
                            <img class="w-100 rounded-3"
                                 src="{{ asset('img/dash/settings/setting-profile-video.jpg') }}" alt="">
                        @else
                            @if(!$isYoutube)
                                <video controls width="100%" height="250">
                                    <source src="{{ $videoUrl }}" type="video/mp4">
                                    Your browser does not support HTML video.
                                </video>
                            @else
                                <iframe
                                    class="rounded-3 {{ is_null($videoUrl) ? 'd-none' : '' }}"
                                    src="{{ $videoUrl }}"
                                    frameborder="0"
                                    width="100%" height="250"
                                    autoplay="false"
                                    title="Video player" frameborder="0"
                                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            @endif
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="video" class="file-upload-label">
                            Select Video
                        </label>
                        <div class="text-start mt-2"
                             x-data="{ isUploadingVideo: false, progressVideo: 0 }"
                             x-on:livewire-upload-start="isUploadingVideo = true"
                             x-on:livewire-upload-finish="isUploadingVideo = false;"
                             x-on:livewire-upload-error="isUploadingVideo = false"
                             x-on:livewire-upload-progress="progressVideo = $event.detail.progress"
                        >

                            <div class="progress mt-2" x-show="isUploadingVideo" style="height: 15px">
                                <div class="progress-bar" role="progressbar"
                                     :style="`width: ${progressVideo}%`"
                                     x-on:aria-valuenow="progressVideo" aria-valuemin="0"
                                     aria-valuemax="100"
                                     x-text="`${progressVideo}%`"></div>
                            </div>
                            <input class="d-none" id="video" wire:model="video" name="video" type="file"/>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <h5 class="fw-bold mb-3">Profile Information

                        {{--Start Popover--}}

                        <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                                data-bs-container="body"
                                data-bs-toggle="popover"
                                data-bs-html="true"
                           data-bs-content="<p>Upload all your information here...</p>
                       <br/><a href='#' class='openModalProfileInformation text-decoration-none text-dark'
                       >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                           aria-hidden="true">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="offerFormProfileInformation" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                             aria-hidden="true"
                        >
                            <div class="modal-dialog" style="max-width: 600px;">
                                <div class="modal-content">
                                    <div class="modal-header border-0 text-center">
                                        <button type="button"
                                                class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12"
                                                data-bs-dismiss="modal" aria-label="Close">X
                                        </button>
                                    </div>


                                    <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                                    >
                                        <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                                        <p class="text-primary-light fw-500">
                                            Upload all your information here for your clients
                                            to see when filling out a form.

                                        </p>

                                        <div class="first-time-user-popup-video">
                                            <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                                   controls>
                                                <source src="{{asset('video/offerform/profile-settings.mp4')}}"
                                                        type="video/mp4">
                                            </video>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>

                        {{--End Popover--}}


                    </h5>
                    <div class="row">
                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">First Name</label>
                            <x-input type="text" class="form-control form-control-lg" name="first_name"
                                     wire:model.defer="state.first_name"/>
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Last Name</label>
                            <x-input type="text" class="form-control-lg" name="last_name"
                                     wire:model.defer="state.last_name"/>
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2 d-flex" for="">
                                Email
                                <div class="d-flex">
                                    <a href="#" class="btn btn-sm btn-primary-light ms-4"
                                       wire:click.prevent="updateEmail">
                                        <div wire:loading.remove wire:target="updateEmail">
                                            Update Email
                                        </div>
                                        <div wire:loading wire:target="updateEmail">
                                            Updating...
                                        </div>
                                    </a>
                                </div>
                            </label>
                            <x-input type="text" class="form-control-lg autocomplete-email"
                                     autocomplete="off"
                                     wire:model.defer="state.email" name="email"/>

                            <x-jet-action-message class="mr-3 alert alert-success p-2 " on="email-updated">
                                {{ __('Update successfully.') }}
                            </x-jet-action-message>
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2 d-flex" for="">
                                Transaction Coordinator Email
                                <div class="d-flex">
                                    <a href="#" class="btn btn-sm btn-primary-light ms-4"
                                       wire:click.prevent="updateTransactionCoordinatorEmail">
                                        <div wire:loading.remove wire:target="updateTransactionCoordinatorEmail">
                                            Update Email
                                        </div>
                                        <div wire:loading wire:target="updateTransactionCoordinatorEmail">
                                            Updating...
                                        </div>
                                    </a>
                                </div>
                            </label>
                            <x-input type="text" class="form-control-lg autocomplete-transaction-email"
                                     name="other_inputs.transaction_coordinator_email"
                                     wire:model.defer="state.other_inputs.transaction_coordinator_email"/>
                            <x-jet-action-message class="alert alert-success p-2 font-weight-normal"
                                                  on="transaction-coordinator-email-updated">
                                {{ __('Update successfully.') }}
                            </x-jet-action-message>
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3" x-data>
                            <label class="fw-bold mb-2" for="">Phone Number</label>
                            <x-input type="text" class="form-control-lg" placeholder="(###) ###-####"
                                     wire:model.defer="state.phone" name="phone"
                                     x-mask="{numericOnly: true, blocks: [0, 3, 3, 4], delimiters: ['(', ') ', '-']}"
                            />
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">License #</label>
                            <x-input type="text" class="form-control-lg"
                                     wire:model.defer="state.other_inputs.licenseNumber"
                                     name="other_inputs.license_number"/>
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Position</label>
                            <x-input type="text" class="form-control-lg" placeholder=""
                                     wire:model.defer="state.other_inputs.position" name="other_inputs.position"/>
                        </div>
                        <div
                            class="form-group col-12 col-lg-6 mb-3"
                            x-data
                            x-init="() => {
                            googleMaps.load().then(function (google) {
                                $refs.office_address.style.height = '5px';
                                var options = {
                                    componentRestrictions: { country: 'us' },
                                    fields: ['address_components', 'geometry'],
                                    types: ['address'],
                                };

                                let autocomplete = new google.maps.places.Autocomplete($refs.office_address, options);

                                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                                    var address = '';
                                    var zipcode = '';
                                    var country = '';
                                    var state = '';
                                    var city = '';

                                    $wire.set('state.address', $refs.office_address.value, true);
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

                                    $wire.set('state.address_components', {city,state,country, zipcode}, true);

                                });
                            });
                        }
                        "
                        >
                            <label class="fw-bold mb-2" for="office_address">Office Address</label>
                            <x-input
                                id="office_address"
                                x-ref="office_address"
                                type="text" class="form-control-lg"
                                name="address"
                                wire:model.defer="state.address"
                            />
                        </div>


                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Website</label>
                            <x-input type="text" class="form-control-lg" wire:model.defer="state.other_inputs.website"
                                     name="other_inputs.website"/>
                        </div>
                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Miscellaneous</label>
                            <x-input
                                type="text"
                                class="form-control-lg"
                                wire:model.defer="state.other_inputs.miscellaneous"
                                name="other_inputs.miscellaneous"
                            />
                        </div>
                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Team Name</label>
                            <x-input type="text" class="form-control-lg" placeholder=""
                                     wire:model.defer="state.other_inputs.team_name" name="other_inputs.team_name"/>
                        </div>
                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Brokerage Name</label>
                            <x-input type="text" class="form-control-lg" placeholder=""
                                     wire:model.defer="state.other_inputs.brokerage_name"
                                     name="other_inputs.brokerage_name"/>
                        </div>
                        <div class="form-group col-12 col-lg-12 mb-3">
                            <label class="fw-bold mb-2" for="">Agent Bio</label>
                            <x-textarea class="form-control" id="" rows="7"
                                        wire:model.defer="state.other_inputs.agent_bio"
                                        name="other_inputs.agent_bio"></x-textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <p class="mb-0">Or Enter Video URL </p>
                    <div class="form-group">
                        <x-input type="text" placeholder="Enter Video url" wire:model.defer="state.video_url"
                                 name="video_url"/>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="form-group mt-2 text-start text-lg-end">
                        <button type="submit" class="btn shadow-sm btn-lg px-5 mt-2 rounded-pill btn-primary-light"
                                wire:loading.attr="disabled" wire:target="photo,updateProfileInformation">
                            <div wire:loading.remove wire:target="updateProfileInformation">
                                Update
                            </div>
                            <div wire:loading wire:target="updateProfileInformation">
                                Updating...
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <x-jet-action-message class="alert alert-success" on="saved">
                {{ __('Updated successfully!') }}
            </x-jet-action-message>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        $(".btnStopVideoOnModalHide").click(function () {
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalSetupForm', function () {
                $('#offerFormSetupGuide').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalProfileInformation', function () {
                $('#offerFormProfileInformation').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>
@endpush

