<div class="card-footer bg-transparent w-full-md-75 editor-and-category-list">
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="row">
                <div class="col-12 col-md-2 d-none d-md-block">
                    <img src="{{asset('v1.1/icons/quick-tip-icon.svg')}}" class="popover-icon mt-1 pop" alt="" style="width: 40px;cursor: pointer"
                         data-bs-container="body"
                         data-bs-toggle="popover"
                         data-bs-html="true"
                         data-bs-content="<p>Watch this video to learn more about the form editor.</p>
                           <a href='#' class='openModalOfferFormFormInputFields text-decoration-none text-dark'
                           >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                         aria-hidden="true"
                    >
{{--                    <i class="fa fa-question-circle popover-icon text-primary-light mt-1"--}}
{{--                       data-bs-toggle="popover" data-bs-trigger="hover"--}}
{{--                       data-bs-content="Points are a fee you pay to your lender to lower your interest rate."--}}
{{--                       aria-hidden="true">--}}
{{--                    </i>--}}
                </div>

                <!-- Modal -->

                <div class="modal fade" id="offerFormFormInputFields" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header border-0 text-center">
                                <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                                </button>
                            </div>

                            <div class=" modal-body text-center px-lg-5 pt-0" style="margin-top: 15px"

                            >
                                <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                                <p class="text-primary-light fw-500">
                                    Watch this video to learn more about the form editor.
                                </p>


                                {{--                                        <div class="rounded-30 mt-2"--}}
                                {{--                                             x-show="!isPlaying"--}}
                                {{--                                             style="background-image: url({{asset('img/dash/offer-forms/how-much-to-offer.png')}});--}}
                                {{--                                                 background-position: center; background-size: cover; background-repeat: no-repeat; height: 320px">--}}


                                {{--                                            <div class="text-center text-white px-2 px-lg-5 py-2  d-flex align-items-center justify-content-center"--}}
                                {{--                                                 style="height: 320px">--}}
                                {{--                                                <div>--}}
                                {{--                                                    <h5 class="fw-normal d-none d-lg-block mb-2">Click here to learn more about</h5>--}}
                                {{--                                                    <a--}}
                                {{--                                                        href="javascript:void(0)"--}}
                                {{--                                                        @click.prevent="isPlaying = true"--}}
                                {{--                                                    >--}}
                                {{--                                                        <i class="fa fa-play bg-white p-3 fs-16 text-center rounded-circle text-primary shadow"></i>--}}
                                {{--                                                    </a>--}}
                                {{--                                                    <h5 class="fw-normal d-none d-lg-block mt-2">Click Play</h5>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}

                                {{--                                        </div>--}}

                                <div  class="first-time-user-popup-video"
                                >
                                    <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                           controls>
                                        <source src="{{asset('video/offerform/offerform-input-module.mp4')}}" type="video/mp4">
                                    </video>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                {{--End Popover--}}



                <div class="col-12 col-md-10">
                    <div class="mb-2 mb-lg-0 align-self-center {{ in_array($stepSection->type, ['inputs']) ? '' : 'text-end' }}">
                        <div class="form-group row {{ in_array($stepSection->type, ['infos']) ? 'justify-content-end' : '' }}">
                            @if(in_array($stepSection->type, ['inputs']))
                                {{--             Editable footer input section start               --}}
                                <div class="mb-2 mb-lg-0 px-lg-0">
                                    <div class="dropdown d-grid text-start offerform-input-selector border rounded">
                                            <button class="btn btn-block text-start buttonOpenDropMenu step-section-input-active"
                                                    type="button" id="inputDropdownMenuButton{{ $stepSection->id }}"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="fs-13 text-muted me-2">Select Input:</span>
                                                {!! $offerFormSection::TYPES_CONFIG[$stepSection->type][$typeConfigType]['icon'] !!}
                                                {{ $offerFormSection::TYPES_CONFIG[$stepSection->type][$typeConfigType]['text'] }}
                                            </button>
                                            <ul class="dropdown-menu shadow mt-2 select-offer-form-category rounded-3 mt-4 scrollbarMenu"
                                                aria-labelledby="inputDropdownMenuButton{{ $stepSection->id }}" style="z-index: 9999">
                                                @foreach($offerFormSection::TYPES_CONFIG[$stepSection->type] as $key => $typeConfig)
                                                    @continue(auth()->user()->hasRole('agent') && $key === 'lead-activation')
                                                    <li>
                                                        <a
                                                            class="dropdown-item fw-500"
                                                            href="#"
                                                            wire:click.debounce.500ms="onChangeSection"
                                                            @click.prevent="$wire.set('typeConfigType', '{{ $key }}');"
                                                        >
                                                            {!! $typeConfig['icon'] !!}
                                                            {{ $typeConfig['text'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                    </div>
                                </div>
                                {{--             Editable footer input section end               --}}
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="row">
                <div class="col-8 align-self-center align-items-center">
                    <ul class="list-group list-group-horizontal list-group-flush text-center rounded-3">
                        @if(in_array($stepSection->type, ['inputs', 'infos']))

                            <li class="list-group-item border-0 bg-transparent d-block d-md-none px-0">
                                <img src="{{asset('v1.1/icons/quick-tip-icon.svg')}}" class="pop" alt="" style="width: 24px;cursor: pointer"
                                     data-bs-container="body"
                                     data-bs-toggle="popover"
                                     data-bs-html="true"
                                     data-bs-content="<p>Watch this video to learn more about the form editor.</p>
                           <a href='#' class='openModalOfferFormFormInputFields text-decoration-none text-dark'
                           >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                                     aria-hidden="true"
                                >
                            </li>

                            <li class="list-group-item px-2 border-list-left border-0 bg-transparent">
                                <a href="#"
                                   wire:click.prevent="goToTheNext('Use the Bar at the bottom to go to the next question')">
                                    <div wire:loading
                                         wire:target="goToTheNext('Use the Bar at the bottom to go to the next question')">
                                        <x-spinner/>
                                    </div>
                                    <img class="w-20 svgIcon mt0-5"
                                         src="{{asset('img/dash/offer-forms/double-arrow-down.svg')}}" alt=""
                                         wire:loading.remove
                                         wire:target="goToTheNext('Use the Bar at the bottom to go to the next question')">
                                </a>
                            </li>

                            <li class="list-group-item px-2 border-0 bg-transparent" x-data="{isUploadingSectionImage: false}">
                                <a href="#"
                                   @click.prevent="$refs.stepSection_image{{ $stepSection->id }}.click()">
                                    <div wire:loading wire:target="onChangeSectionImage,stepSectionImage" x-bind:style="isUploadingSectionImage ? 'display: block;' : ''">
                                        <x-spinner/>
                                    </div>
                                    <img class="w-20 svgIcon" src="{{asset('img/dash/offer-forms/image-icon.svg')}}"
                                         alt="" wire:loading.remove wire:target="onChangeSectionImage,stepSectionImage" x-bind:style="isUploadingSectionImage ? 'display: none;' : ''"/>
                                </a>
                                <input
                                    type="file"
                                    class="d-none"
                                    id="stepSection_image{{ $stepSection->id }}"
                                    x-ref="stepSection_image{{ $stepSection->id }}"
                                    name="stepSection.image{{ $stepSection->id }}"
                                    x-on:livewire-upload-start="isUploadingSectionImage = true"
                                    x-on:livewire-upload-finish="isUploadingSectionImage = false; @this.onChangeSectionImage()"
                                    wire:model="stepSectionImage"
                                />
                            </li>
                        @endif
                        <li class="list-group-item px-2 border-0 bg-transparent">
                            <a href="#" wire:click.prevent="duplicate()">
                                <div wire:loading wire:target="duplicate">
                                    <x-spinner/>
                                </div>
                                <img class="w-18 svgIcon" src="{{asset('img/dash/offer-forms/clone.svg')}}" alt=""
                                     wire:loading.remove wire:target="duplicate">
                            </a>
                        </li>
                        <li class="list-group-item px-2 border-0 bg-transparent">
                            <a href="#"
                               data-bs-toggle="modal"
                               data-bs-target="#deleteConfirmation{{ $stepSection->id ?? 0 }}Modal"
                            >
                                <img class="w-16 svgIcon" src="{{asset('img/dash/offer-forms/delete-icon.svg')}}"
                                     alt="">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-4 bl align-self-center">
                    @if(in_array($stepSection->type, ['inputs']))
                        <div class="d-flex justify-content-between align-items-center">
                             <span class="text-muted fs-10 fw-500 pe-1 pe-lg-0"
                                   for="stepSectionRequired{{ $stepSection->id }}">Required</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input required-form-check-input" type="checkbox"
                                       id="stepSectionRequired{{ $stepSection->id }}"
                                       wire:change="onChangeSection" wire:model="stepSection.required"/>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



{{--    <div class="row justify-content-end">--}}


{{--        <div--}}
{{--            class="col-12 col-lg-6 mb-2 mb-lg-0 align-self-center {{ in_array($stepSection->type, ['inputs']) ? 'border-lg-end' : 'text-end' }}">--}}

{{--            <div class="form-group row {{ in_array($stepSection->type, ['infos']) ? 'justify-content-end' : '' }}">--}}
{{--                @if(in_array($stepSection->type, ['inputs']))--}}
{{--                    --}}{{--             Editable footer input section start               --}}
{{--                    <label for="type_config_input{{ $stepSection->id }}"--}}
{{--                           class="col-sm-2 col-form-label fs-12 text-muted px-lg-0">Select input:</label>--}}
{{--                    <div class="col-sm-6 mb-2 mb-lg-0 px-lg-0">--}}
{{--                        <div class="dropdown d-grid text-start offer-form-select border rounded">--}}
{{--                            <button class="btn btn-block text-start buttonOpenDropMenu step-section-input-active"--}}
{{--                                    type="button" id="inputDropdownMenuButton{{ $stepSection->id }}"--}}
{{--                                    data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                {!! $offerFormSection::TYPES_CONFIG[$stepSection->type][$typeConfigType]['icon'] !!}--}}
{{--                                {{ $offerFormSection::TYPES_CONFIG[$stepSection->type][$typeConfigType]['text'] }}--}}
{{--                            </button>--}}
{{--                            <ul class="dropdown-menu shadow mt-2 select-offer-form-category rounded-3 mt-4 scrollbarMenu"--}}
{{--                                aria-labelledby="inputDropdownMenuButton{{ $stepSection->id }}" style="z-index: 9999">--}}
{{--                                @foreach($offerFormSection::TYPES_CONFIG[$stepSection->type] as $key => $typeConfig)--}}
{{--                                    @continue(auth()->user()->hasRole('agent') && $key === 'lead-activation')--}}
{{--                                    <li>--}}
{{--                                        <a--}}
{{--                                            class="dropdown-item fw-500"--}}
{{--                                            href="#"--}}
{{--                                            wire:click.debounce.500ms="onChangeSection"--}}
{{--                                            @click.prevent="$wire.set('typeConfigType', '{{ $key }}');"--}}
{{--                                        >--}}
{{--                                            {!! $typeConfig['icon'] !!}--}}
{{--                                            {{ $typeConfig['text'] }}--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}{{--             Editable footer input section end               --}}
{{--                @endif--}}

{{--                --}}{{--             Editable footer Actions e.g. add image, duplicate, & delete start               --}}
{{--                <div class="col-sm-4 px-lg-0 d-flex justify-content-center">--}}
{{--                    <ul class="list-group list-group-horizontal list-group-flush text-center rounded-3">--}}
{{--                        @if(in_array($stepSection->type, ['inputs', 'infos']))--}}
{{--                            <li class="list-group-item border-0 bg-transparent">--}}
{{--                                <a href="#"--}}
{{--                                   wire:click.prevent="goToTheNext('Use the Bar at the bottom to go to the next question')">--}}
{{--                                    <div wire:loading--}}
{{--                                         wire:target="goToTheNext('Use the Bar at the bottom to go to the next question')">--}}
{{--                                        <x-spinner/>--}}
{{--                                    </div>--}}
{{--                                    <img class="w-18 svgIcon"--}}
{{--                                         src="{{asset('img/dash/offer-forms/double-arrow-down.svg')}}" alt=""--}}
{{--                                         wire:loading.remove--}}
{{--                                         wire:target="goToTheNext('Use the Bar at the bottom to go to the next question')">--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="list-group-item border-0 bg-transparent" x-data="{isUploadingSectionImage: false}">--}}
{{--                                <a href="#"--}}
{{--                                   @click.prevent="$refs.stepSection_image{{ $stepSection->id }}.click()">--}}
{{--                                    <div wire:loading wire:target="onChangeSectionImage,stepSectionImage" x-bind:style="isUploadingSectionImage ? 'display: block;' : ''">--}}
{{--                                        <x-spinner/>--}}
{{--                                    </div>--}}
{{--                                    <img class="w-19 svgIcon" src="{{asset('img/dash/offer-forms/image-icon.svg')}}"--}}
{{--                                         alt="" wire:loading.remove wire:target="onChangeSectionImage,stepSectionImage" x-bind:style="isUploadingSectionImage ? 'display: none;' : ''"/>--}}
{{--                                </a>--}}
{{--                                <input--}}
{{--                                    type="file"--}}
{{--                                    class="d-none"--}}
{{--                                    id="stepSection_image{{ $stepSection->id }}"--}}
{{--                                    x-ref="stepSection_image{{ $stepSection->id }}"--}}
{{--                                    name="stepSection.image{{ $stepSection->id }}"--}}
{{--                                    x-on:livewire-upload-start="isUploadingSectionImage = true"--}}
{{--                                    x-on:livewire-upload-finish="isUploadingSectionImage = false; @this.onChangeSectionImage()"--}}
{{--                                    wire:model="stepSectionImage"--}}
{{--                                />--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        <li class="list-group-item border-0 bg-transparent">--}}
{{--                            <a href="#" wire:click.prevent="duplicate()">--}}
{{--                                <div wire:loading wire:target="duplicate">--}}
{{--                                    <x-spinner/>--}}
{{--                                </div>--}}
{{--                                <img class="w-18 svgIcon" src="{{asset('img/dash/offer-forms/clone.svg')}}" alt=""--}}
{{--                                     wire:loading.remove wire:target="duplicate">--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item border-0 bg-transparent">--}}
{{--                            <a href="#"--}}
{{--                               data-bs-toggle="modal"--}}
{{--                               data-bs-target="#deleteConfirmation{{ $stepSection->id ?? 0 }}Modal"--}}
{{--                            >--}}
{{--                                <img class="w-16 svgIcon" src="{{asset('img/dash/offer-forms/delete-icon.svg')}}"--}}
{{--                                     alt="">--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                --}}{{--             Editable footer Actions e.g. add image, duplicate, & delete end               --}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if(in_array($stepSection->type, ['inputs']))--}}
{{--            <div class="col-12 col-lg-6 mb-3 mb-lg-0 align-self-center">--}}
{{--                <div class="row">--}}
{{--                    --}}{{--             Editable footer Actions e.g. required start               --}}
{{--                    <div class="col-sm-3 order-2 order-lg-1 align-self-center d-flex justify-content-center">--}}
{{--                        <div class="form-check form-switch">--}}
{{--                            <label class="form-check-label ms-2 fs-10 fw-500"--}}
{{--                                   for="stepSectionRequired{{ $stepSection->id }}">Required</label>--}}
{{--                            <input class="form-check-input required-form-check-input" type="checkbox"--}}
{{--                                   id="stepSectionRequired{{ $stepSection->id }}"--}}
{{--                                   wire:change="onChangeSection" wire:model="stepSection.required"/>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}{{--             Editable footer Actions e.g. required end               --}}
{{--                    --}}{{--             Editable footer Actions e.g. categorize start               --}}
{{--                    <div class="col-sm-9 mb-2 mb-lg-0 order-1 order-lg-2 align-self-center">--}}

{{--                    </div>--}}
{{--                    --}}{{--             Editable footer Actions e.g. categorize end               --}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}


@push('scripts')
    <script>
        $(".btnStopVideoOnModalHide").click(function(){
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalOfferFormFormInputFields', function(){
                $('#offerFormFormInputFields').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>


@endpush
