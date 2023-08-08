<div class="container mb-5 pb-4">
    @if($offerForm->is_standard_step_library_form)
        <a
            href="{{ route('dash.offer-forms.index') }}"
            class="btn btn-lg w-210 btn-white-black-hover me-2 mb-2 mb-lg-0 fw-bold shadow-sm mt-2 fs-14 rounded-pill"
        >
            <i class="fa fa-angle-left fs-20 pe-2"></i>Back
        </a>
        <h1 class="text-center text-primary my-5">
            <img src="{{ asset('logo/iconic.png') }}" class="me-2" height="40" width="40" alt="Admin Standard Step Library" style="margin-top: -7px"/> Admin Standard Step Library
        </h1>
    @else
        <form class="container my-3 d-grid gap-3 editFormButtonList px-0" wire:submit.prevent="submit"
              wire:key="offer-forms-edit-{{$offerForm->id}}">

            @if($isEditing)
                <div class="form-group">
                    <x-input type="text" placeholder="Name"
                             class="rounded-pill border-0 px-3 shadow-sm text-center" name="offerForm.name"
                             wire:model="offerForm.name"/>
                </div>
                <div class="form-group">
                    <x-input type="text" placeholder="Description"
                             class="rounded-pill border-0 px-3 shadow-sm text-center" name="offerForm.description"
                             wire:model="offerForm.description"/>
                </div>
            @else
                <h2 class="text-center text-capitalize fw-bold text-primary-light">{{ $offerForm->name }}
                    <a href="" class="text-decoration-none"  wire:click.prevent="setIsEditing(true)">
                        <img class="w-22" src="{{asset('img/dash/offer-forms/pencil.png')}}" alt="">
                    </a>
                </h2>
                <p class="text-center fw-500 text-capitalize ">{{ $offerForm->description }}</p>
            @endif

            <div class="d-gird gap-4 mb-3 offerFormzlistzbutton">
                <a
                    href="{{ route('dash.offer-forms.index') }}"
                    class="btn btn-lg w-210 btn-white-black-hover btn-hover-white-img me-2 mb-2 mb-lg-3 fw-bold shadow-sm fs-14 rounded-pill"
                >
                    <i class="fa fa-angle-left fs-20 me-3"></i> Back
                </a>
                @if($isEdit)
                    @if($isEditing)
                        <x-button
                            class="btn btn-lg w-210  btn-primary-light-black-hover px-4 text-white mb-2 fw-500 mb-2 btn-edit-form mb-lg-3 shadow-sm me-2 fs-14 rounded-pill"
                            type="submit"
                        >
                            <div wire:loading.remove wire:target="submit">
                                Save
                            </div>
                            <div wire:loading wire:target="submit">
                                Saving...
                            </div>
                        </x-button>
                    @else
{{--                        <a--}}
{{--                            href="#"--}}
{{--                            class="btn btn-lg w-210  btn-primary-light-black-hover px-4 text-white mb-2 fw-500 mb-2 btn-edit-form mb-lg-3 shadow-sm me-2 fs-14 rounded-pill"--}}
{{--                            wire:click="setIsEditing(true)"--}}
{{--                        >--}}
{{--                            <img class="w-20 pe-2" src="{{asset('img/menu-icons/white-pencil.svg')}}" alt=""> Change Form Name--}}
{{--                        </a>--}}
                    @endif

                    @if($offerForm->getFormTotalStepsCount() > 0)
                        <a
                            href="{{ $offerForm->getViewFormLink(false, route('dash.offer-forms.edit', $offerForm->slug)) }}&clr"
                            class="btn btn-lg w-210  btn-primary-light-black-hover text-white fw-500 mb-2 btn-edit-form mb-lg-3 shadow-sm me-2 fs-14 rounded-pill   "
                        >
                            <img class="w-20 me-2" src="{{asset('img/menu-icons/eye-icon.svg')}}" alt=""> View Form
                        </a>
                    @endif
                    <div class="btn-group offerFormzlistzbutton">
                        <a href="#"
                           class="btn btn-lg w-210 btn-primary-light-black-hover text-white fw-500 mb-2 btn-edit-form mb-lg-3 shadow-sm me-2 fs-14 rounded-pill send-form-btn"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <div wire:loading wire:target="copyLink('{{ $offerForm->slug }}')">
                                <x-spinner class="me-2"/>
                            </div>
{{--                            <i class="fa fa-paper-plane pe-2" wire:loading.remove--}}
{{--                               wire:target="copyLink('{{ $offerForm->slug }}')"></i>--}}

                            <img class="w-17 me-2" src="{{asset('img/menu-icons/send-form.svg')}}" alt=""
                                 wire:loading.remove
                                 wire:target="copyLink('{{ $offerForm->slug }}')"
                            >

                            Send Form</a>

                        <ul class="dropdown-menu bg-primary-light border-0 rounded-3 mt-2 text-white py-0 "
                            aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item li-first-child text-white" href="#"
                                   wire:click.prevent="copyLink('{{ $offerForm->slug }}')">
                                    <i class="fa fa-link fs-18 me-2"></i>
                                    Copy Link</a></li>
                            <li><a class="dropdown-item text-white" href="#" data-bs-toggle="modal"
                                   data-bs-target="#sendFormByPhone{{ $offerForm->id }}Modal"><i
                                        class="fa fa-mobile fs-22 me-3"></i> Text Form</a>
                            </li>
                            <li><a class="dropdown-item li-last-child text-white" href="#" data-bs-toggle="modal"
                                   data-bs-target="#sendFormByEmail{{ $offerForm->id }}Modal"><i
                                        class="fa fa-envelope fs-18 me-2"></i> Email Form</a>
                            </li>
                        </ul>
                    </div>

                    <a
                        href="#"
                        data-bs-toggle="modal" data-bs-target="#sharedFormModal"
                        class="btn btn-lg w-210  btn-primary-light-black-hover text-white fw-500 mb-2 btn-edit-form mb-lg-3 shadow-sm me-2 fs-14 rounded-pill"
                    >
                        <i class="fa fa-upload fs-20 pe-2"></i>Share Form
                    </a>


                        {{--Start Popover--}}

                        <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                                data-bs-container="body"
                                data-bs-toggle="popover"
                                data-bs-html="true"
                           data-bs-content="<p>You can share this form with your team or all OfferForm users...</p>
                           <a href='#' class='openModalOfferFormForm text-decoration-none text-dark'
                           >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                           aria-hidden="true">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="offerFormForm" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                            You can share this form with your team or all OfferForm users. You can send it to your clients. And you can customize the form.
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
                                                <source src="{{asset('video/offerform/offerform-form.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        {{--End Popover--}}



                        <div class="modal fade hideableModal" id="sharedFormModal" data-bs-backdrop="static" data-bs-keyboard="false"
                             tabindex="-1" aria-labelledby="createOfferFormLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-30">
                                    <div class="modal-header ms-auto border-0 pb-0 text-white">
                                        <a href="javascript:void(0)"
                                           class="text-decoration-none"
                                           data-bs-dismiss="modal" aria-label="Close">
                                           <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                                        </a>
                                    </div>
                                    <div class="modal-body d-grid gap-4 py-5">
                                        @if(auth()->user()->is_part_of_a_team)
                                            <a
                                                href="#"
                                                class="btn btn-lg btn-primary-light-black-hover py-3 fw-bold shadow-sm fs-14 rounded-pill text-uppercase"
                                                wire:click.prevent="shareOrUnshareWithTeam"
                                                wire:loading.attr="disabled"
                                            >
                                                <div wire:loading wire:target="shareOrUnshareWithTeam">
                                                    <x-spinner />
                                                </div>
                                                Share Form to Team
                                            </a>
                                        @endif
                                        <button
                                            href="#"
                                            wire:click.prevent="shareOrUnshareUniversally"
                                            class="btn btn-lg btn-primary-light-black-hover py-3 fw-bold shadow-sm fs-14 rounded-pill text-uppercase"
                                            {{ $offerForm->universally_shared ? 'disabled' : '' }}
                                            wire:loading.attr="disabled"
                                        >
                                            <div wire:loading wire:target="shareOrUnshareUniversally">
                                                <x-spinner />
                                            </div>
                                            Share to all OfferForm Users
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                @else
                    <x-button
                        class="btn btn-lg w-210  btn-primary-light-black-hover text-white fw-500 mb-2 btn-edit-form mb-lg-3 shadow-sm me-2 fs-14 rounded-pill"
                        type="submit"
                    >
                        <div wire:loading.remove wire:target="submit">
                            Add
                        </div>
                        <div wire:loading wire:target="submit">
                            Adding...
                        </div>
                    </x-button>
                @endif
            </div>
        </form>
    @endif
    @if($isEdit)
        <div class="row my-5">
            <div class="form-group col-12 col-lg-7 my-1 ">
                <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                    <div class="input-group-prepend border-0 align-self-center">
                        <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">
                            <div wire:loading wire:target="search">
                                <x-spinner class="me-2"/>
                            </div>
                            <img class="w-17" src="{{asset('img/menu-icons/search-icon.svg')}}" alt=""
                                 wire:loading.remove wire:target="search">
                        </button>
                    </div>
                    <x-input type="text" placeholder="Search OfferForm Steps" aria-describedby="button-addon4"
                             class="form-control form-control-lg rounded-pill bg-none border-0 search"
                             wire:model.debounce.500ms="search"/>
                </div>
            </div>
            <div class="form-group col-12 col-lg-5 my-1 btn-group stepLibraryGroup">

                {{--                <a class="btn btn-lg rounded-pill btn-white-black-hover btn-header btn-hover-white-img shadow-sm fs-14 my-2 my-lg-0 ms-3 btn-step-library--}}
                {{--                 fw-bold text-capitalize"--}}
                {{--                   wire:click="changeDisplayAs()">--}}
                {{--                    <img class="w-17 me-2" src="{{asset('img/menu-icons/white-grid.svg')}}" alt=""> {{ $displayAs }}--}}
                {{--                </a>--}}

                <a href="#"
                   class="btn btn-lg btn-white-black-hover btn-hover-white-img rounded-pill btn-header fw-bold shadow-sm my-2 my-lg-0 ms-3 fs-14 d-none d-lg-block"
                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                   style="font-size: 13px"
                >
                    <div wire:loading wire:target="changeDisplayAs">
                        <x-spinner class="me-2"/>
                    </div>
                    @switch($displayAs)
                        @case('grid')
                        <img class=" me-2" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt=""
                             wire:loading.remove wire:target="changeDisplayAs"/> Grid
                        @break
                        @case('list')
                        <img class=" me-2" width="15" src="{{asset('img/agent/icons/list.svg')}}" alt=""
                             wire:loading.remove wire:target="changeDisplayAs"/> List
                        @break
                        {{--                    @case('compact')--}}
                        {{--                    <img class=" me-2" width="15" src="{{asset('img/agent/icons/compact.svg')}}" alt=""/> Compact--}}
                        {{--                    @break--}}
                    @endswitch

                    <img src="{{asset('img/menu-icons/arrow-dropdown-down.svg')}}" class="w-12 ms-2" alt="">
                </a>

                <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white py-0"
                    aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item li-first-child text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('grid')"
                           href="#">
                            <img class=" me-3" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt="">Grid</a>
                    </li>
                    <li><a class="dropdown-item li-last-child text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('list')"
                           href="#">
                            <img class=" me-3" width="15" src="{{asset('img/agent/icons/list.svg')}}" alt="">List</a>
                    </li>
                    {{--                    <li><a class="dropdown-item text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('compact')"--}}
                    {{--                           href="#">--}}
                    {{--                            <img class=" me-3" width="15" src="{{asset('img/agent/icons/compact.svg')}}" alt="">Compact</a>--}}
                    {{--                    </li>--}}
                </ul>

                <a href="{{ route('dash.offer-forms.create') }}"
                   class="btn btn-lg btn-primary-light-black-hover btn-header text-white fw-500 px-1 shadow-sm my-2 my-lg-0 ms-3 btn-step-library fs-14 rounded-pill"
                   data-bs-toggle="modal" data-bs-target="#addCustomStepToOfferFormModal"
                   wire:click="addStep"
                   onclick="document.getElementById('offerFormStep_name{{ $offerForm->id }}').value = ''"
                >
                    <img class="w-19 me-2" src="{{asset('img/menu-icons/add-step.svg')}}" alt=""> ADD STEP
                </a>

                <div wire:ignore.self class="modal hideableModal fade" id="addCustomStepToOfferFormModal"
                     data-bs-backdrop="static"
                     data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="addCustomStepToOfferFormLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-3">
                            <div class="row modal-header border-0">
                                <div class="col-8">
                                    <h5 class="mb-0 text-primary pt-3">Step Add/Edit</h5>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="javascript:void(0)"
                                       class="text-decoration-none"
                                       data-bs-dismiss="modal" aria-label="Close">
                                       <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                                    </a>
                                </div>

                            </div>

                            <form class="modal-body" wire:submit.prevent="submitStep"
                                  wire:key="offer-forms-step-add-or-edit-{{uniqid()}}">
                                <x-input
                                    id="offerFormStep_name{{ $offerForm->id }}"
                                    name="offerFormStep.name"
                                    placeholder="Enter your step name here..."
                                    wire:change="$set('offerFormStep.name', $event.target.value)"
                                />
                                <div class="d-flex mt-3">
                                    <x-button type="submit" class="btn-primary ms-auto mt-2">
                                        <div wire:loading.remove wire:target="submitStep">
                                            {{ $offerFormStep->id !== null ? 'Save' : 'Add' }}
                                        </div>
                                        <div wire:loading wire:target="submitStep">
                                            {{ $offerFormStep->id !== null ? 'Saving...' : 'Adding...' }}
                                        </div>
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if(!$offerForm->is_standard_step_library_form)
                    <a href="#"
                       class="btn btn-lg btn-primary-light-black-hover btn-header text-white fw-500 shadow-sm px-1 my-2 my-lg-0 ms-3 btn-step-library fs-14 rounded-pill "
                       data-bs-toggle="modal" data-bs-target="#addStepFromLibraryToOfferFormModal"
                       wire:ignore.self
                    >
                       @role('agent') <img class="w-19 me-2" src="{{asset('img/menu-icons/step-library.svg')}}" alt="">  STEP LIBRARY @endrole

                       @role('admin') <img class="w-19 me-2" src="{{asset('img/menu-icons/admin-step-lib-icon.svg')}}" alt="">  STEP LIBRARY @endrole

                    </a>

                    <div wire:ignore.self class="modal fade" id="addStepFromLibraryToOfferFormModal"
                         data-bs-backdrop="static"
                         data-bs-keyboard="false"
                         tabindex="-1" aria-labelledby="addStepFromLibraryToOfferFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl position-relative">
                            <div class="modal-content rounded-3">

                                <div class="row modal-header border-0">

                                    <div class="col-10 ps-lg-3">
                                        <h2 class="modal-title text-primary-light mx-auto text-center"
                                            id="addStepFromLibraryToOfferFormModalLabel">
                                            <img class="img-fluid me-0 me-lg-3" src="{{asset('img/menu-icons/step-library.svg')}}"
                                                 alt="">
                                            Add Step From Library</h2>
                                    </div>
                                    <div class="col-2 text-end">
                                        <a href="javascript:void(0)"
                                           class="text-decoration-none"
                                           data-bs-dismiss="modal" aria-label="Close">
                                           <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                                        </a>
                                    </div>

                                </div>
                                <div class="modal-body">
                                    <div class="row mb-4">
                                        <div class="col-12 col-lg-9 mb-2">
                                            <div
                                                class="input-group form-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                                                <div class="input-group-prepend border-0 align-self-center">
                                                    <button id="button-addon4" type="button"
                                                            class="btn btn-link text-dark rounded-circle">
                                                        <div wire:loading wire:target="searchFromLibrary">
                                                            <x-spinner class="me-2"/>
                                                        </div>
                                                        <img class="w-17"
                                                             src="{{asset('img/menu-icons/search-icon.svg')}}"
                                                             alt="" wire:loading.remove wire:target="searchFromLibrary">
                                                    </button>
                                                </div>
                                                <x-input type="text" placeholder="Search Pre-made OfferForm Steps"
                                                         aria-describedby="button-addon4"
                                                         class="form-control form-control-lg rounded-pill bg-none border-0 search"
                                                         wire:model.debounce.500mx="searchFromLibrary"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3 mb-2 d-grid">
                                            <a href="#"
                                               wire:click.prevent="submitStepsFromLibrary"
                                               class="btn btn-lg rounded-pill btn-primary-lighter text-white shadow-sm px-5 text-uppercase" {{ count($libraryStepsSelected) === 0 ? 'disabled' : '' }}>
                                                <div wire:loading.remove wire:target="submitStepsFromLibrary">
                                                    Submit
                                                </div>
                                                <div wire:loading wire:target="submitStepsFromLibrary">
                                                    Submitting...
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach($offerFormLibrarySteps as $offerFormLibraryStep)
                                            <div class="col-12 col-md-4 col-lg-4 mb-4">
                                                <label class="form-check-label" style="cursor: pointer"
                                                       for="libraryStep{{$offerFormLibraryStep->id}}{{ $loop->index }}">
                                                     <div class="card border-0 rounded-3 shadow-sm hover-border"
                                                     style="background-color: #ebebeb">
                                                    <img src="{{ $offerFormLibraryStep->stepCardHeaderImage }}?v={{ $loop->index.time() }}"
                                                         class="card-img-top px-4 pt-4 shadow-sm" alt="custom step"
                                                         onerror="this.src = '/img/offer-form-step/card-header-bg.jpeg'"
                                                         wire:ignore
                                                         draggable="false"/>
                                                    <div class="card-body bg-white" style="border-bottom-right-radius: 8px;border-bottom-left-radius: 8px">
                                                        <h5 class="card-title">
                                                            <a href="#"
                                                               class="text-decoration-none text-capitalize fs-16 fw-bold">
                                                                <x-application-logo class="" style="height: 30px"/>
                                                            </a>
                                                        </h5>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mt-2">
                                                            <a href="#"
                                                               class="text-decoration-none me-2 fw-bold fs-16 text-primary">
                                                                {{ $offerFormLibraryStep->name }}
                                                            </a>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           wire:model.defer="libraryStepsSelected"
                                                                           value="{{ $offerFormLibraryStep->id }}"
                                                                           id="libraryStep{{$offerFormLibraryStep->id}}{{ $loop->index }}"
                                                                           style="width: 18px;height: 18px"
                                                                    >


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </label>
                                            </div>
                                        @endforeach
                                        @foreach($referralPartnerTypesLibrarySteps as $referralPartnerTypesLibraryStep)
                                                <div class="col-12 col-md-4 col-lg-4 mb-4">
                                                    <label class="form-check-label" style="cursor: pointer; width: 100%"
                                                           for="libraryStep{{$referralPartnerTypesLibraryStep->id}}{{ $loop->index }}">
                                                        <div class="card border-0 rounded-3 shadow-sm hover-border"
                                                             style="background-color: #ebebeb">
                                                            <div class="card-img-top d-flex justify-content-center align-items-center"
                                                                 style="background-color: #d5b6ed; height: 238px;">
                                                                <h1 class="mb-0 fw-bolder text-white text-center">{{ $referralPartnerTypesLibraryStep->name }}</h1>
                                                            </div>
                                                            <div class="card-body bg-white" style="border-bottom-right-radius: 8px;border-bottom-left-radius: 8px">
                                                                <h5 class="card-title">
                                                                    <a href="#"
                                                                       class="text-decoration-none text-capitalize fs-16 fw-bold">
                                                                        <x-application-logo class="" style="height: 30px"/>
                                                                    </a>
                                                                </h5>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mt-2">
                                                                    <a href="#"
                                                                       class="text-decoration-none me-2 fw-bold fs-16 text-primary">
                                                                        {{ $referralPartnerTypesLibraryStep->name }}
                                                                    </a>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                   wire:model.defer="libraryStepsSelected"
                                                                                   value="{{ $referralPartnerTypesLibraryStep->referralPartners->first()?->offerForm->id }}"
                                                                                   id="libraryStep{{$referralPartnerTypesLibraryStep->id}}{{ $loop->index }}"
                                                                                   style="width: 18px;height: 18px"
                                                                            />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    @if($displayAs === 'grid')
        <div class="row" wire:sortable="changeSortOrder" wire:key="stg{{ time() }}">
            @foreach($offerFormSteps as $step)
                @if(!$offerForm->is_standard_step_library_form && !is_null($step->referral_partner_id))
                    <div class="col-12 col-md-6 col-lg-4  droppable-zone-for-partner-type @role('agent') mb-4 @endrole  @role('admin') mb-5 @endrole " wire:sortable.item="{{ $step->id }}"
                         wire:key="{{$step->id}}"
                    >
                        <div class="card rounded-3 shadow-sm hover-border offerFormCardGrid">
                            <a
                                @if($step->need_to_upgrade)
                                href="#"
                                data-bs-toggle="modal" data-bs-target="#upgradeToPremiumModal"
                                @else
                                href="{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $step->slug]) }}"
                                @endif
                                class="text-decoration-none"
                            >
                                <div class="card-img-top d-flex justify-content-center align-items-center"
                                     style="background-color: #d5b6ed; height: 290px">
                                    <h1 class="mb-0 fw-bolder text-white">{{ $step->referralPartner?->referralPartnerType?->name }}</h1>
                                </div>
                            </a>
                            <div class="card-body bg-white"
                                 style="border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                <h5 class="card-title text-center text-primary-light text-white">
                                    -
                                </h5>
                                <div class="row align-items-center mt-3 rounded-3 stepsGrid">
                                    <div class="col-5 align-items-center">
                                        <a
                                            href="#"
                                            class="text-decoration-none me-2 text-muted"
                                            data-bs-toggle="modal"
                                            @if($step->need_to_upgrade)
                                            data-bs-target="#upgradeToPremiumModal"
                                            @else
                                            data-bs-target="#deleteConfirmation{{ $step->id ?? 0 }}Modal"
                                            @endif
                                        >
                                            <img class="w-17 svgIcon"
                                                 src="{{asset('img/dash/offer-forms/delete-gray-icon.svg')}}"
                                                 alt="">
                                        </a>
                                        @if($offerForm->is_standard_step_library_form)
                                            <a
                                                href="#" class="text-decoration-none me-2 text-muted"
                                                wire:click.prevent="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})"
                                            >
                                                <div wire:loading wire:target="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})">
                                                    <x-spinner />
                                                </div>
                                                <img class="w-17"
                                                     src="{{asset('img/menu-icons/library-step-'.($step->active ? 'active' : 'inactive').'.svg')}}"
                                                     alt="" wire:loading.remove wire:target="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})" />
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-2 text-center">
                                        <a href="#" wire:sortable.handle class="text-center" style="cursor: grab"> <img
                                                class="img-fluid small-icon mx-auto"
                                                src="{{asset('img/dash/offer-forms/grid-gray-icon.svg')}}" alt=""></a>
                                    </div>
                                    <div class="col-5 text-end">
                                        <div class="mb-0 text-muted d-flex align-items-center justify-content-end">
                                            @if($step->library)
                                                <img src="{{ asset('logo/iconic.png') }}" class="me-2" alt="{{ $step->name }}"
                                                     style="height: 30px" draggable="false"/>
                                            @endif
                                            <div class="fw-bold">
                                                Step {{ $loop->iteration }}

                                                @if($offerForm->is_standard_step_library_form)
                                                    <a
                                                        href="#" class="text-decoration-none me-2 text-muted"
                                                        wire:click.prevent="toggleStepLocked({{ $step->id }}, {{ $step->locked ? 0 : 1 }})"
                                                    >
                                                        <div wire:loading wire:target="toggleStepLocked({{ $step->id }}, {{ $step->locked ? 0 : 1 }})">
                                                            <x-spinner style="height: 13px; width: 13px" />
                                                        </div>
                                                        <i class="fa fa-lock {{ $step->locked ? 'text-primary' : '' }} ms-2 fs-18"
                                                           aria-hidden="true" wire:loading.remove wire:target="toggleStepLocked({{ $step->id }}, {{ $step->locked ? 0 : 1 }})"></i>
                                                    </a>
                                                @elseif($step->need_to_upgrade)
                                                    <i class="fa fa-lock text-primary ms-2 fs-18" aria-hidden="true"></i>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 col-md-6 col-lg-4  @role('agent') mb-4 @endrole  @role('admin') mb-5 @endrole  " wire:sortable.item="{{ $step->id }}"
                     wire:key="{{$step->id}}"
                         x-data=""
                         x-on:drop=""
                         x-on:drop.prevent="
                            $wire.emit('setOfferFormSortOrder', {{ $step->id }}, event.dataTransfer.getData('text/plain'));
                         "
                         x-on:dragover.prevent=""
                         x-on:dragleave.prevent=""
                    >
                    <div class="card rounded-3 shadow-sm hover-border offerFormCardGrid">
                        <a
                            @if($step->need_to_upgrade)
                            href="#"
                            data-bs-toggle="modal" data-bs-target="#upgradeToPremiumModal"
                            @else
                            href="{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $step->slug]) }}"
                            @endif
                        >
                            <img
                                src="{{ $step->stepCardHeaderImage }}?v={{ $loop->index.time() }}"
                                class="card-img-top px-4 pt-4 shadow-sm"
                                onerror="this.src = '/img/offer-form-step/card-header-bg.jpeg'"
                                wire:ignore
                                alt="{{ $step->name }}" draggable="false"/>
                        </a>
                        <div class="card-body bg-white"
                             style="border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                            <h5 class="card-title text-center text-primary-light">
                                <a
                                    @if($step->need_to_upgrade)
                                    href="#"
                                    data-bs-toggle="modal" data-bs-target="#upgradeToPremiumModal"
                                    @else
                                    href="{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $step->slug]) }}"
                                    @endif
                                    class="text-decoration-none text-capitalize fw-bold d-inline-block text-truncate" style="max-width: 250px;">
                                    {{ $step->name }}
                                </a>

                                <a href="#" class="text-decoration-none text-capitalize fs-16 fw-bold"
                                   wire:click="editStep({{ $step->id }})"
                                   onclick="document.getElementById('offerFormStep_name{{ $offerForm->id }}').value = '{{ $step->name }}'"
                                   data-bs-toggle="modal" data-bs-target="#addCustomStepToOfferFormModal">
                                    <img class="w-15 ms-2 mt0-10 svgIcon" src="{{asset('img/menu-icons/step-edit-icon.svg')}}" alt="">
                                </a>
                            </h5>
                            <div class="row align-items-center mt-3 rounded-3 stepsGrid">
                                <div class="col-5 align-items-center">
                                    <a
                                        @if($step->need_to_upgrade)
                                        href="#"
                                        data-bs-toggle="modal" data-bs-target="#upgradeToPremiumModal"
                                        @else
                                        href="{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $step->slug]) }}"
                                        @endif
                                        class="text-decoration-none me-2 text-muted "
                                    >
                                        <img class="w-20 svgIcon"
                                             src="{{asset('img/dash/offer-forms/edit-gray-icon.svg')}}"
                                             alt="">
                                    </a>
                                    <a href="#" class="text-decoration-none me-2 text-muted "
                                       wire:click.prevent="duplicate({{ $step->id }})">
                                        <div wire:loading wire:target="duplicate({{ $step->id }})">
                                            <x-spinner class="me-2"/>
                                        </div>
                                        <img class="w-16 svgIcon" src="{{asset('img/dash/offer-forms/clone.svg')}}"
                                             alt="" wire:loading.remove wire:target="duplicate({{ $step->id }})">
                                    </a>
                                    <a
                                        href="#"
                                        class="text-decoration-none me-2 text-muted"
                                        data-bs-toggle="modal"
                                        @if($step->need_to_upgrade)
                                        data-bs-target="#upgradeToPremiumModal"
                                        @else
                                        data-bs-target="#deleteConfirmation{{ $step->id ?? 0 }}Modal"
                                        @endif
                                    >
                                        <img class="w-17 svgIcon"
                                             src="{{asset('img/dash/offer-forms/delete-gray-icon.svg')}}"
                                             alt="">
                                    </a>
                                    @if($offerForm->is_standard_step_library_form)
                                        <a
                                            href="#" class="text-decoration-none me-2 text-muted"
                                            wire:click.prevent="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})"
                                        >
                                            <div wire:loading wire:target="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})">
                                                <x-spinner />
                                            </div>
                                            <img class="w-17"
                                                 src="{{asset('img/menu-icons/library-step-'.($step->active ? 'active' : 'inactive').'.svg')}}"
                                                 alt="" wire:loading.remove wire:target="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})" />
                                        </a>
                                    @endif
                                </div>
                                <div class="col-2 text-center">
                                    <a href="#" wire:sortable.handle class="text-center" style="cursor: grab"> <img
                                            class="img-fluid small-icon mx-auto"
                                            src="{{asset('img/dash/offer-forms/grid-gray-icon.svg')}}" alt=""></a>
                                </div>
                                <div class="col-5 text-end">
                                    <div class="mb-0 text-muted d-flex align-items-center justify-content-end">
                                        @if($step->library)
                                            <img src="{{ asset('logo/iconic.png') }}" class="me-2" alt="{{ $step->name }}"
                                                 style="height: 30px" draggable="false"/>
                                        @endif
                                        <div class="fw-bold">
                                            Step {{ $loop->iteration }}

                                            @if($offerForm->is_standard_step_library_form)
                                                <a
                                                    href="#" class="text-decoration-none me-2 text-muted"
                                                    wire:click.prevent="toggleStepLocked({{ $step->id }}, {{ $step->locked ? 0 : 1 }})"
                                                >
                                                    <div wire:loading wire:target="toggleStepLocked({{ $step->id }}, {{ $step->locked ? 0 : 1 }})">
                                                        <x-spinner style="height: 13px; width: 13px" />
                                                    </div>
                                                    <i class="fa fa-lock {{ $step->locked ? 'text-primary' : '' }} ms-2 fs-18"
                                                       aria-hidden="true" wire:loading.remove wire:target="toggleStepLocked({{ $step->id }}, {{ $step->locked ? 0 : 1 }})"></i>
                                                </a>
                                                @elseif($step->need_to_upgrade)
                                                  <i class="fa fa-lock text-primary ms-2 fs-18" aria-hidden="true"></i>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @else
        <div  wire:key="stng{{ time() }}">
            <div class="card border-0 mb-3 py-3 bg-primary d-none d-lg-block">
                <div class="card-body p-0">
                    <div class="row text-white rounded-2 text-center">
                        <div class="col-12 col-lg-2 fw-bold">Step Order</div>
                        <div class="col-12 col-lg-3 fw-bold">Step Name</div>
                        <div class="col-12 col-lg-2 fw-bold">Template</div>
                        <div class="col-12 col-lg-2 fw-bold">Last Modified</div>
                        <div class="col-12 col-lg-2 fw-bold">Last Opened</div>
                        <div class="col-12 col-lg-1 fw-bold">Menu</div>
                    </div>
                </div>
            </div>

            <div  wire:sortable="changeSortOrder">
                @foreach($offerFormSteps as $step)
                    <div class="card border-0 hover-border mb-3 py-3" wire:sortable.item="{{ $step->id }}" wire:key="{{$step->id}}">
                        <a href="#" wire:sortable.handle class="text-center d-block d-lg-none" style="cursor: grab"> <img
                                class="img-fluid xm-small-icon mx-auto" src="{{asset('img/form-builder/icons/grid.svg')}}"
                                alt="">
                        </a>
                        <div class="card-body row text-center">
                            <div class="col-12 col-lg-2 mb-3 mb-lg-0 fw-bold text-muted">
                                Step Order: {{ $loop->iteration }}
                                @if($offerForm->is_standard_step_library_form)
                                    <a
                                        href="#" class="text-decoration-none me-2 text-muted"
                                        wire:click.prevent="toggleStepLocked({{ $step->id }}, {{ $step->locked ? 0 : 1 }})"
                                    >
                                        <i class="fa fa-lock {{ $step->locked ? 'text-primary' : '' }} ms-2 fs-18"
                                           aria-hidden="true"></i>
                                    </a>
                                @elseif($step->need_to_upgrade)
                                    <i class="fa fa-lock text-primary ms-2 fs-18" aria-hidden="true"></i>
                                @endif
                            </div>
                            <div class="col-12 col-lg-3 mb-3 mb-lg-0 text-md-start text-lg-start text-xl-start">
                                <a class="text-decoration-none fw-bold text-capitalize d-inline-block text-truncate"
                                   style="max-width: 200px;"
                                   @if($step->need_to_upgrade)
                                   href="#"
                                   data-bs-toggle="modal" data-bs-target="#upgradeToPremiumModal"
                                   @else
                                   href="{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $step->slug]) }}"
                                    @endif
                                >
                                    <div style="width: 30px; display: inline-block">
                                        @if($step->source === 'library')

                                            <img class="img-fluid small-icon"
                                                 src="{{asset('img/form-builder/icons/offer_form_logo.png')}}"
                                                 alt=""/>
                                        @endif
                                    </div>
                                        {{ $step->name }}
                                </a>

                                <a href="#"
                                   class="text-decoration-none"
                                   onclick="document.getElementById('offerFormStep_name{{ $offerForm->id }}').value = '{{ $step->name }}'"
                                   data-bs-toggle="modal" data-bs-target="#addCustomStepToOfferFormModal"
                                >
                                    <img class="w-15 ms-2 mt0-15 svgIcon" src="{{asset('img/menu-icons/step-edit-icon.svg')}}" alt="">
                                </a>

                            </div>
                            <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                                <a href="#" wire:sortable.handle class="text-center d-none d-lg-block" style="cursor: grab"> <img
                                        class="img-fluid xm-small-icon mx-auto" src="{{asset('img/form-builder/icons/grid.svg')}}"
                                        alt="">
                                </a>
                            </div>
                            <div class="col-12 col-lg-2 mb-3 mb-lg-0">{{ $step->updated_at->timezone(session('ip_position:timezone', 'UTC'))->format('M d, Y h:i a') }}</div>
                            <div class="col-12 col-lg-2 mb-3 mb-lg-0">{{ $step->updated_at->timezone(session('ip_position:timezone', 'UTC'))->format('M d, Y h:i a') }}</div>
                            <div class="col-12 col-lg-1  mb-lg-0 text-primary fw-bold">
                                <a class="px-2" href="#" id="showListData" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white "
                                    aria-labelledby="showListData">
                                    <li>
                                        <a
                                            class="dropdown-item text-dark tc-black-hover-warning fw-bold"
                                            href="#"
                                            data-bs-toggle="modal"
                                            @if($step->need_to_upgrade)
                                            data-bs-target="#upgradeToPremiumModal"
                                            @else
                                            data-bs-target="#deleteConfirmation{{ $step->id ?? 0 }}Modal"
                                            @endif
                                        ><i class="fa fa-trash fs-16 mx-2"></i>Delete
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item text-dark tc-black-hover-warning fw-bold" href="#"
                                           wire:click="duplicate({{ $step->id }})"><i class="fa fa-clone fs-16 mx-2"></i>Duplicate</a>
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item text-dark tc-black-hover-warning fw-bold"
                                            @if($step->need_to_upgrade)
                                            href="#"
                                            data-bs-toggle="modal" data-bs-target="#upgradeToPremiumModal"
                                            @else
                                            href="{{ route('dash.offer-forms.step.edit', [$offerForm->slug, $step->slug]) }}"
                                            @endif
                                        ><i class="fa fa-edit fs-16 mx-2"></i>Edit</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <livewire:referral-partners.standard-step-library :display-as="$displayAs" wire:key="rst{{ time() }}" :offer-form="$offerForm"/>

    <livewire:offer-forms.send-modal :by="'Email'" :offer-form="$offerForm"/>
    <livewire:offer-forms.send-modal :by="'Phone'" :offer-form="$offerForm"/>
    @foreach($offerFormSteps as $step)
        <x-modals.delete-confirmation :id="$step->id" :action='"destroy($step->id)"'
                                      :key="time().$step->id">

            <x-slot name="title">
                Are you sure you want to delete this step?
            </x-slot>

            <x-slot name="description">
                You would not be able to recover this!
            </x-slot>

        </x-modals.delete-confirmation>

    @endforeach
    <div class="modal fade" id="upgradeToPremiumModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="upgradeToPremiumLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 600px !important;">
            <div class="modal-content">
                <div class="modal-header border-0 ms-auto pb-0">
                    <a href="javascript:void(0)"
                       class="text-decoration-none"

                       data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30 svg-hover-black" alt="">
                    </a>
                </div>
                <div class="modal-body">
                    <div class="modal-content border-0">
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="fa fa-lock fa-3x text-primary-light"></i>

                                <p class="mt-5 fw-500">Editing or removing this step is only possible on OfferForm
                                    premium.</p>
                                <p class="fw-500">To upgrade your account please click below to upgrade to premium.</p>

                                <a href="{{route('dash.settings')}}#upGradePricingTable"
                                   class="btn btn-lg btn-primary-light-black-hover text-uppercase mt-3 px-4">Upgrade to
                                    premium</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $(function (){--}}
{{--            var h = $(window).height();--}}
{{--            document.addEventListener('drag', function (e) {--}}
{{--                var mousePosition = e.pageY - $(window).scrollTop();--}}
{{--                var topRegion = 220;--}}
{{--                var bottomRegion = h - 220;--}}
{{--                if(e.which === 1 && (mousePosition < topRegion || mousePosition > bottomRegion)){    // e.wich = 1 => click down !--}}
{{--                    var distance = e.clientY - h / 2;--}}
{{--                    distance = distance * 0.1; // <- velocity--}}
{{--                    $(document).scrollTop( distance + $(document).scrollTop()) ;--}}
{{--                }else{--}}
{{--                    $(document).unbind('mousemove');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
@push('scripts')
    <script>
        $(".btnStopVideoOnModalHide").click(function(){
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalOfferFormForm', function(){
                $('#offerFormForm').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>


@endpush
