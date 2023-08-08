<div>
    @push('stylesheets')
        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }

            .donut-inner .percent {
                font-size: 65px;
                margin-bottom: 3px;
                margin-top: 0;
                font-weight: bolder;
            }

            .donut-inner .percent small {
                font-size: 35px;
                font-weight: bolder;
                font-family: Arial;
            }

            .donut-inner .price {
                margin: 0;
                font-size: 30px;
            }

        </style>
        {{--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">--}}
    @endpush

    @include('livewire.offer-forms.steps.partials.edit-form-back-button')

    <div class="">

        <div class="d-grid gap-4 mb-5 pb-5 position-relative" wire:sortable="changeSectionSortOrder">
            @foreach($stepSections as $stepSection)
                <livewire:offer-forms.steps.step-section
                    :step-section="$stepSection"
                    :loop-index="$loop->index"
                    :route-is-edit="$routeIdEdit"
                    wire:key="{{$stepSection->id}}"
                />
            @endforeach

            @if($offerFormStep->need_to_upgrade === 0)
                <div class="form-builder-sidebar-section form-builder-sidebar-static-icons d-flex attachToolBar  "
                     id="attachToolBar">
                    <div class="form-builder-sidebar-icons align-self-center bg-white position-relative rounded-3">

                        <a href="" class="position-absolute top-50 start-0 translate-middle toggle-icon-menu-side-bar"
                           style="z-index: 99">
                            <img class="w-12 ms-3 img-toggle-icon " src="{{asset('img/menu-icons/toggle-arrow.svg')}}"
                                 alt="">
                        </a>

                        {{-- For Desktop Sidebar--}}
                        <ul class="list-group list-group-flush offer-form-sidebar-list py-3 d-none d-md-block text-center rounded-3"
                            style="box-shadow: -1px 0px 32px 3px rgba(0,0,0,0.48);">
                            <li class="list-group-item border-0 px-2 py-2">
                                <a href="#" class="" wire:click.prevent="addSection('inputs')"
                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                   data-bs-content="The Input module is used to collect info and ask questions."
                                >
                                    <div wire:loading wire:target="addSection('inputs')">
                                        <x-spinner/>
                                    </div>
                                    <img class="w-28 svgIcon" src="{{asset('img/menu-icons/plus-icon.svg')}}" alt=""
                                         wire:loading.remove wire:target="addSection('inputs')">
                                </a>
                            </li>
                            <li class="list-group-item border-0 px-2 py-2">
                                <a href="#" class="" wire:click.prevent="addSection('infos', 'display-text')"
                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                   data-bs-content="The blurb module is used to display text."
                                >
                                    <div wire:loading wire:target="addSection('infos', 'display-text')">
                                        <x-spinner/>
                                    </div>
                                    <img class="w-28 svgIcon" src="{{asset('img/menu-icons/chat-icon.svg')}}" alt=""
                                         wire:loading.remove
                                         wire:target="addSection('infos', 'display-text')">
                                </a>
                            </li>
                            <li class="list-group-item border-0 px-2 py-2">
                                <a href="#" class="p-1" wire:click.prevent="addSection('medias', 'image')"
                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                   data-bs-content="The photo module is used to display images."
                                >
                                    <div wire:loading wire:target="addSection('medias', 'image')">
                                        <x-spinner/>
                                    </div>
                                    <img class="w-24 svgIcon" src="{{asset('img/menu-icons/image-icon.svg')}}" alt=""
                                         wire:loading.remove wire:target="addSection('medias', 'image')">
                                </a>
                            </li>
                            <li class="list-group-item border-0 px-2 py-2">
                                <a href="#" class="p-1" wire:click.prevent="addSection('medias', 'video')"
                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                   data-bs-content="The video module is used to display videos."
                                >
                                    <div wire:loading wire:target="addSection('medias', 'video')">
                                        <x-spinner/>
                                    </div>
                                    <img class="w-24 svgIcon" src="{{asset('img/menu-icons/video-icon.svg')}}" alt=""
                                         wire:loading.remove wire:target="addSection('medias', 'video')">
                                </a>
                            </li>
                        </ul>

                        {{-- For Mobile Sidebar--}}
                        <ul class="list-group list-group-flush offer-form-sidebar-list py-3 d-block d-md-none text-center rounded-3"
                            style="box-shadow: -1px 0px 32px 3px rgba(0,0,0,0.48);">
                            <li class="list-group-item border-0 px-2 py-1">
                                <a href="#" wire:click.prevent="addSection('inputs')">
                                    <div wire:loading wire:target="addSection('inputs')">
                                        <x-spinner/>
                                    </div>
                                    <img class="img-width-0 w-0 " src="{{asset('img/dash/offer-forms/plus-icon.png')}}"
                                         alt=""
                                         wire:loading.remove wire:target="addSection('inputs')">
                                </a>
                            </li>
                            <li class="list-group-item border-0 px-2 py-1">
                                <a href="#" wire:click.prevent="addSection('infos', 'display-text')">
                                    <div wire:loading wire:target="addSection('infos', 'display-text')">
                                        <x-spinner/>
                                    </div>
                                    <img class="img-width-0 w-0 " src="{{asset('img/menu-icons/chat-icon.svg')}}" alt=""
                                         wire:loading.remove
                                         wire:target="addSection('infos', 'display-text')">
                                </a>
                            </li>
                            <li class="list-group-item border-0 px-2 py-1">
                                <a href="#" wire:click.prevent="addSection('medias', 'image')">
                                    <div wire:loading wire:target="addSection('medias', 'image')">
                                        <x-spinner/>
                                    </div>
                                    <img class="img-width-0 w-0 " src="{{asset('img/dash/offer-forms/image-icon.svg')}}"
                                         alt=""
                                         wire:loading.remove wire:target="addSection('medias', 'image')">
                                </a>
                            </li>
                            <li class="list-group-item border-0 px-2 py-1">
                                <a href="#" wire:click.prevent="addSection('medias', 'video')">
                                    <div wire:loading wire:target="addSection('medias', 'video')">
                                        <x-spinner/>
                                    </div>
                                    <img class="img-width-0 w-0 " src="{{asset('img/dash/offer-forms/video-icon.png')}}"
                                         alt=""
                                         wire:loading.remove wire:target="addSection('medias', 'video')">
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            @endif
        </div>

    </div>
    @if((is_null($offerFormStep->referral_partner_id) && $offerForm->slug !== 'standard-step-library') || (!is_null($offerFormStep->referral_partner_id) && $offerForm->slug !== 'standard-step-library'))
        <div class="">
            @php
                $stepSlugs = $offerForm->getOfferFormStepsQuery()->pluck('slug')->toArray();
                $totalStepCount = $offerForm->getFormTotalStepsCount();
                $currentStepNo = array_search($offerFormStep->slug, $stepSlugs) + 1;
            @endphp

            <div
                class="container rounded-3 {{ count($stepSections) > 0 ? 'fixed-bottom mb-70' : 'fixed-bottom mb-70' }} px-3 py-1 py-lg-3 progress- shadow offerForm-bootom-nav"
                style="background-color: #4F405B;max-width: 980px;margin: auto">

                <div class="row text-white">
                    <div
                        class="col-12 col-lg-5 px-2 my-1 align-self-center order-3 order-lg-1 my-lg-0 text-end text-lg-start">
                        <a href="{{ $offerForm->getPreviewLink($offerFormStep) }}"
                           class="btn btn-lg btn-primary-lighter text-white px-3 rounded-pill fs-12 w-110 mx-1 mx-lg-2  text-uppercase">
                            <img src="{{asset('img/menu-icons/eye-icon.svg')}}" class="w-16 me-1 img-none-sm" alt="">Preview
                        </a>
                        <a href="#"
                           class="btn btn-lg btn-primary-lighter text-white px-3 rounded-pill fs-12 w-110 mx-1 mx-lg-2  text-uppercase"
                           data-bs-toggle="modal" data-bs-target="#sendFormByPhone{{ $offerForm->id }}Modal"
                        >
                            <img src="{{asset('img/menu-icons/text-icon.svg')}}" class="me-1 img-none-sm"
                                 style="width: 12px" alt=""> Text
                        </a>
                        <a href="#"
                           class="btn btn-lg btn-primary-lighter text-white px-3 rounded-pill fs-12 w-110 mx-1 mx-lg-2  text-uppercase"
                           data-bs-toggle="modal" data-bs-target="#sendFormByEmail{{ $offerForm->id }}Modal"
                        >
                            <img src="{{asset('img/menu-icons/mail-icon.svg')}}" class="w-15 me-1 img-none-sm" alt="">Email
                        </a>
                    </div>
                    <div class="col-12 col-lg-2 px-2 my-1 order-2 my-lg-0 text-start text-lg-center position-relative ">

                        <div x-data="{isStepNameEditing: false}" class="">
                            <div x-show="!isStepNameEditing" class="text-center d-none ">
                            <span class="d-inline-block text-truncate mx-auto" style="max-width: 95px;">
                                {{ $offerFormStep->name }}
                            </span>
                                <a
                                    href="#" class="ms-2 text-white" x-on:click.prevent="isStepNameEditing = true">
                                    <img src="{{asset('img/menu-icons/progress-edit-icon.svg')}}"
                                         class="me-2 mt0-15 w-15"
                                         alt="">
                                </a>
                            </div>
                            <x-input class="form-control-sm border-0 bg-transparent text-white text-center"
                                     wire:model.debounce.500ms="offerFormStep.name" x-show="isStepNameEditing"
                                     @click.away="isStepNameEditing = false;"/>

                            @php
                                $stepCount = (int)(($currentStepNo / $totalStepCount) * 100);
                            @endphp

                            <div class="circle-progress-mobile d-block d-lg-none position-relative ">
                                <div
                                    class="progress-circle position-absolute p{{ $stepCount }} {{$stepCount <= 50 ? 'bg-white': 'bg-primary-light d-180'}}">
                                <span
                                    class="fs-14 text-white {{$stepCount > 50 ? 'd-180': ''}}">{{ $currentStepNo }} / {{ $totalStepCount }}</span>
                                    <div class="left-half-clipper">
                                        <div class="first50-bar"></div>
                                        <div
                                            class="value-bar {{$stepCount <= 50 ? 'border-primary-light': 'border-white'}} "></div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none d-lg-block">
                                <p class="mb-2 fs-18 p-step">{{ $currentStepNo }} / {{ $totalStepCount }}</p>
                                <div class="outer-progress-bar">
                                    <div class="progress" style="height: 5px">
                                        <div
                                            class="progress-bar"
                                            role="progressbar"
                                            style="width: {{ ($currentStepNo / $totalStepCount) * 100 }}%"
                                            aria-valuenow="{{ ($currentStepNo / $totalStepCount) * 100 }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-5 px-2 my-1 align-self-center order-1 order-lg-3 my-lg-0  text-end">
                        <div>
                            <a href="{{ route('dash.offer-forms.edit', $offerForm->slug) }}"
                               class="btn btn-lg px-3 btn-white-black-hover rounded-pill fs-12  w-110 mx-1 mx-lg-2 text-uppercase"
                               wire:click.prevent="goNext('{{ route('dash.offer-forms.edit', $offerForm->slug) }}')"
                            >
                                <div wire:target="goNext('{{ route('dash.offer-forms.edit', $offerForm->slug) }}')" wire:loading>
                                    <x-spinner class="me-2"/>
                                </div>
                                Exit
                            </a>
                            @if($currentStepNo > 1)
                                <a
                                    href="{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $stepSlugs[$currentStepNo - 2]]) }}"
                                    class="btn btn-lg btn-primary-lighter text-white px-3 rounded-pill fs-12  w-110 mx-1 mx-lg-2 text-uppercase"
                                    wire:click.prevent="goNext('{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $stepSlugs[$currentStepNo - 2]]) }}')"
                                >
                                    <div wire:target="goNext('{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $stepSlugs[$currentStepNo - 2]]) }}')" wire:loading>
                                        <x-spinner class="me-2"/>
                                    </div>
                                    PREVIOUS
                                </a>
                            @endif
                            @if($currentStepNo < $totalStepCount)
                                <a
                                    href="{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $stepSlugs[$currentStepNo]]) }}"
                                    class="btn btn-lg btn-primary-light text-white px-3 rounded-pill fs-12  w-110 mx-1 mx-lg-2 text-uppercase"
                                    wire:click.prevent="goNext('{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $stepSlugs[$currentStepNo]]) }}')"
                                >
                                    <div wire:target="goNext('{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $stepSlugs[$currentStepNo]]) }}')" wire:loading>
                                        <x-spinner class="me-2"/>
                                    </div>
                                    NEXT
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <livewire:offer-forms.send-modal :by="'Email'" :offer-form="$offerForm"/>
    <livewire:offer-forms.send-modal :by="'Phone'" :offer-form="$offerForm"/>

    <div
        class="modal fade"
        id="requiredEditStepSectionModal"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
        x-data="{
           isPlaying: false,
           messages: []
        }"
        @required-fields-needs-to-fill.window="
           $('#requiredEditStepSectionModal').modal('show');
           messages = event.detail.messages;
           console.log(messages);
        "
    >
        <div class="modal-dialog" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center border-0 pb-0 text-white">
                    <img src="{{asset('v1.1/icons/alert-icon.svg')}}" class="w-28" alt="">
                    <p class="mb-0 text-dark fs-16 fw-500">Click to scroll to each <span
                            class="fw-bold">Required Field</span></p>
                    <a href="javascript:void(0)"
                       class="text-decoration-none"
                       data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                    </a>
                </div>

                <div class=" modal-body text-center px-lg-5 pt-0" style="margin-top: 15px">
                    <div class="">
                        <template x-for="message in messages" :key="message.id">
                            <div>
                                <a href="#!" :data-id="message.id" class="btn outline-none text-primary-light fs-16 fw-500 required-section-field " x-show="message.title">
                                    Question Title <span class="text-dark">must be selected to move forward</span>
                                </a>
                                <a href="#!" :data-id="message.id" class="btn outline-none text-primary-light fs-16 fw-500 required-section-field " x-show="message.category">
                                    Question  Category <span class="text-dark">must be selected to move forward</span>
                                </a>
                            </div>
                        </template>
                    </div>

                    <div
                        class="rounded-15 mt-3"
                        x-show="!isPlaying"
                        style="background-image: url({{asset('img/dash/offer-forms/how-much-to-offer.png')}}); background-position: center; background-size: cover; background-repeat: no-repeat; height: 220px"
                    >

                        <div
                            class="text-center text-white px-2 px-lg-5 py-2  d-flex align-items-center justify-content-center"
                            style="height: 220px">
                            <div>
                                <h5 class="fw-normal d-none d-lg-block mb-2">Click here to learn more about categories, and question names</h5>
                                <a
                                    href="javascript:void(0)"
                                    @click.prevent="isPlaying = true; $refs.required_fields_intro_video.play()"
                                >
                                    <i class="fa fa-play bg-white p-3 fs-16 text-center rounded-circle text-primary shadow"></i>
                                </a>
                                <h5 class="fw-normal d-none d-lg-block mt-2">Click Play</h5>
                            </div>
                        </div>

                    </div>

                    <div class="first-time-user-popup-video"
                         @click.away="isPlaying = false; $refs.required_fields_intro_video.pause()"
                         x-show="isPlaying"
                    >
                        <video width="100%" height="220" class="stopVideoOnModalHide rounded-15 object-cover" controls x-ref="required_fields_intro_video">
                            <source src="{{asset('video/offerform/required-title-and-category.mp4')}}"
                                    type="video/mp4">
                        </video>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @foreach($stepSections as $stepSection)
        @if(!str_contains($stepSection->slug, '-buyer-personal-info-'))
            <x-modals.delete-confirmation :id="$stepSection->id" :action='"destroySection($stepSection->id)"'
                                          :key="time().$stepSection->id">

                <x-slot name="title">
                    Are you sure you want to delete this section?
                </x-slot>

                <x-slot name="description">
                    You would not be able to recover this!
                </x-slot>

            </x-modals.delete-confirmation>
        @endif
        @if(str_contains($stepSection->slug, '-buyer-personal-info-3'))
            <x-modals.delete-confirmation
                :id="$stepSection->id"
                action="destroyBuyerPersonalInformationSections('{{$stepSection->slug}}')"
                :key="time().$stepSection->id"
            >
                <x-slot name="title">
                    Are you sure you want to delete this buyer personal information sections?
                </x-slot>
                <x-slot name="description">
                    You would not be able to recover this!
                </x-slot>
            </x-modals.delete-confirmation>
        @endif
    @endforeach

    @push('scripts')

        <script>
            $(document).ready(function () {

                window.livewire.on('scroll-to-bottom', function (to) {
                    setTimeout(() => {
                        let el = $(`#${to}`);
                        $("html, body").animate({scrollTop: el.offset().top - el.height()}, 500);
                    }, 100);
                });

                $('.toggle-icon-menu-side-bar').on('click', function (e) {
                    $('.form-builder-sidebar-section').toggleClass("form-builder-sidebar-static-icons");
                    $('.form-builder-sidebar-icons').toggleClass("w-50");
                    $('.img-width-0').toggleClass("w-22");
                    $('.img-toggle-icon').toggleClass("rotate-toggle-icon");
                    e.preventDefault();
                });
            });

        </script>

        <script>
            $('#requiredEditStepSectionModal').on('hidden.bs.modal', function () {
                $('video').contents().find('video')[0].pause();
            });
        </script>

        <script>
            $(".btnStopVideoOnModalHide").click(function () {
                $('.stopVideoOnModalHide').trigger('pause');
            });
        </script>

    @endpush
</div>
