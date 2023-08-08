<div class="container pb-3 mt-3 mb-5">
    @role('admin')
    <h1 class="text-center text-primary mb-5">
        <img src="{{ asset('logo/iconic.png') }}" class="me-2" height="40" width="40" alt="Admin Standard Step Library"
             style="margin-top: -7px"/>
        Standard OfferForms
    </h1>
    @endrole
    <div class="row mb-md-3 pb-md-5 mb-lg-3 pb-lg-5">
        <div class="form-group col-12 @role('admin') col-lg-3 @endrole @role('agent') col-lg-6 @endrole mb-3 mb-lg-0 ">
            <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                <div class="input-group-prepend border-0 align-self-center">
                    <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">
                        <div wire:target="search" wire:loading>
                            <x-spinner class="me-2"/>
                        </div>
                        <img class="w-17" src="{{asset('img/menu-icons/search-icon.svg')}}" alt="" wire:loading.remove
                             wire:target="search"/>
                    </button>
                </div>
                <x-input type="text" placeholder="Search Forms by OfferForm Name" aria-describedby="button-addon4"
                         class="form-control form-control-lg rounded-pill bg-none border-0 search"
                         wire:model.debounce.500ms="search"/>
            </div>
        </div>
        <div class="col-12  @role('agent') col-lg-6 @endrole @role('admin') col-lg-9 @endrole mb-3 mb-lg-0 btn-group">
            @role('agent')
            <a href="#"
               class="btn btn-lg max-width-btn rounded-pill btn-white-black-hover btn-hover-white-img btn-header btn-header-sm me-3 fw-bold shadow-sm px-2 fs-14 text-capitalize"
               id="offerFormSortByDropdownMenu" data-bs-toggle="dropdown" aria-expanded="false"
            >
                <div wire:loading wire:target="changeSortBy">
                    <x-spinner class="me-2"/>
                </div>
                <span class="fw-bold fs-14 me-1" wire:loading.remove
                      wire:target="changeSortBy">Sort:</span> {{ str_replace('_', ' ', Str::title($sortBy)) }}
                <img src="{{asset('img/menu-icons/arrow-dropdown-down.svg')}}" class="w-12 ms-2" alt="">
            </a>

            <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 py-0 text-white shadow sortList"
                aria-labelledby="offerFormSortByDropdownMenu">
                <li class="position-relative d-none d-md-block">
                    <img src="{{asset('img/menu-icons/up-down-arrow.svg')}}" alt=""
                         class="top-0 start-0 position-absolute ms-2" style="width: 10px;">
                </li>
                <li class="">
                    <a class="dropdown-item li-first-child {{ $sortBy === 'manually' ? 'active' : 'text-dark' }} fw-500 fs-14"
                       href="#" wire:click.prevent="changeSortBy('manually')"><span class="ps-4"></span> Manually</a>
                </li>
                <li class="">
                    <a class="dropdown-item {{ $sortBy === 'user' ? 'active' : 'text-dark' }} fw-500 fs-14"
                       href="#" wire:click.prevent="changeSortBy('user')"><span class="ps-4"></span> User</a>
                </li>
                <li>
                    <a class="dropdown-item {{ $sortBy === 'a_z' ? 'active' : 'text-dark' }} fw-500 fs-14"
                       wire:click.prevent="changeSortBy('a_z')" href="#"><span class="ps-4"></span> A To Z</a>
                </li>
                <li>
                    <a class="dropdown-item fw-500 fs-14 {{ $sortBy === 'last_opened' ? 'active' : 'text-dark' }}"
                       href="#" wire:click.prevent="changeSortBy('last_opened')"><span class="ps-4"></span> Last Opened</a>
                </li>
                <li>
                    <a class="dropdown-item {{ $sortBy === 'last_modified' ? 'active' : 'text-dark' }} fw-500 fs-14"
                       href="#" wire:click.prevent="changeSortBy('last_modified')"><span class="ps-4"></span> Last
                        Modified</a>
                </li>
                <li>
                    <a class="dropdown-item fw-500 fs-14 {{ $sortBy === 'shared_forms' ? 'active' : 'text-dark' }}"
                       href="#" wire:click.prevent="changeSortBy('shared_forms')">
                        <img class="w-18 me-2" src="{{asset('img/menu-icons/shared-form-icon.png')}}"
                             style="object-fit: cover;height: 18px" alt=""> Shared
                        Forms
                    </a>
                </li>
                <li>
                    <a class="dropdown-item fw-500 fs-14 {{ $sortBy === 'team_forms' ? 'active' : 'text-dark' }} "
                       href="#" wire:click.prevent="changeSortBy('team_forms')">
                        <img class="w-18 me-2" src="{{asset('img/menu-icons/team-form.png')}}"
                             style="object-fit: cover;height: 18px" alt=""> Team Forms
                    </a>
                </li>
                <li>
                    <a class="dropdown-item li-last-child {{ $sortBy === 'standard_forms' ? 'active' : 'text-dark' }} fw-500 fs-14"
                       href="#" wire:click.prevent="changeSortBy('standard_forms')">
                        <img class="w-18 me-2" src="{{asset('img/menu-icons/standard-form.png')}}"
                             style="object-fit: cover;height: 18px" alt=""> Standard
                        OfferForms
                    </a>
                </li>
            </ul>
            @endrole

            <a href="#"
               class="btn btn-lg btn-white-black-hover btn-hover-white-img rounded-pill btn-header fw-bold shadow-sm me-3 px-2 fs-14 d-none d-lg-block"
               id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
               style="font-size: 13px"
            >
                <div wire:loading wire:target="changeDisplayAs">
                    <x-spinner class="me-2"/>
                </div>
                @switch($displayAs)
                    @case('grid')
                    <img class="me-2" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt="" wire:loading.remove
                         wire:target="changeDisplayAs"/> Grid
                    @break
                    @case('list')
                    <img class="me-2" width="15" src="{{asset('img/agent/icons/list.svg')}}" alt="" wire:loading.remove
                         wire:target="changeDisplayAs"/> List
                    @break
                    {{--                    @case('compact')--}}
                    {{--                    <img class=" me-2" width="15" src="{{asset('img/agent/icons/compact.svg')}}" alt=""/> Compact--}}
                    {{--                    @break--}}
                @endswitch

                <img src="{{asset('img/menu-icons/arrow-dropdown-down.svg')}}" class="w-12 ms-2" alt="">
            </a>

            <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white py-0"
                aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item li-first-child text-dark fw-500 fs-14"
                       wire:click.prevent="changeDisplayAs('grid')"
                       href="#">
                        <img class=" me-3" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt="">Grid</a>
                </li>
                <li><a class="dropdown-item li-last-child text-dark fw-500 fs-14"
                       wire:click.prevent="changeDisplayAs('list')"
                       href="#">
                        <img class=" me-3" width="15" src="{{asset('img/agent/icons/list.svg')}}" alt="">List</a>
                </li>
                {{--                <li><a class="dropdown-item text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('compact')"--}}
                {{--                       href="#">--}}
                {{--                        <img class=" me-3" width="15" src="{{asset('img/agent/icons/compact.svg')}}" alt="">Compact</a>--}}
                {{--                </li>--}}
            </ul>
            @hasanyrole('super-admin|admin')
                <a href="{{ route('dash.offer-forms.edit', 'standard-step-library') }}"
                   class="btn btn-lg rounded-pill btn-header me-3 btn-primary-light-black-hover fw-bold shadow-sm fs-14"
                >
                    <img src="{{ asset('img/menu-icons/step-library-book.svg') }}" class="w-17 me-2"/> Step Library
                </a>
                <a href="{{ route('dash.categories') }}"
                   class="btn btn-lg rounded-pill btn-header me-3 btn-primary-light-black-hover fw-bold shadow-sm fs-14"
                >
                    <img src="{{ asset('img/menu-icons/cat-white-icon.svg') }}" class="w-17 me-2"/> Categories
                </a>
                <div>
                    <a href="#"
                       class="btn btn-lg rounded-pill btn-header me-3 btn-primary-light-black-hover fw-bold shadow-sm fs-14"
                       id="sharedForms" data-bs-toggle="dropdown" aria-expanded="false"
                       style="font-size: 13px"

                    >
                        <img
                            src="{{ asset('img/menu-icons/admin-icon/edit-icon.svg') }}"
                            class="w-12 mx-2"
                            alt=""
                            style="filter:  brightness(0) invert(1); -webkit-filter: brightness(0) invert(1);"
                        /> Shared Forms
                    </a>
                    <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white py-0"
                        aria-labelledby="sharedForms">
                        <li>
                            <a
                                class="dropdown-item li-first-child text-dark fw-500 fs-14"
                                href="#"
                                data-bs-toggle="modal" data-bs-target="#addSharedFormModal"
                            >
                                Shared Forms
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item li-last-child text-dark fw-500 fs-14"
                                href="#"
                                data-bs-toggle="modal" data-bs-target="#addTeamFormModal"
                            >
                                Team Forms
                            </a>
                        </li>
                        {{--                <li><a class="dropdown-item text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('compact')"--}}
                        {{--                       href="#">--}}
                        {{--                        <img class=" me-3" width="15" src="{{asset('img/agent/icons/compact.svg')}}" alt="">Compact</a>--}}
                        {{--                </li>--}}
                    </ul>
                </div>
            @endhasanyrole
            <a href="{{ route('dash.offer-forms.create') }}"
               class="btn btn-lg rounded-pill btn-header btn-header-sm me-3 fw-bold shadow-sm fs-14
                @role('agent')btn-primary-lighter-black-hover @endrole
               @role('admin')btn-primary-light-black-hover @endrole"
               @role('agent')
               data-bs-toggle="modal" data-bs-target="#createOfferFormModal"
                @endrole
            >
                <img src="{{ asset('img/menu-icons/plus-white-icon.svg') }}" class="w-17 me-2"/>
                @role('agent') Add New OfferForm @endrole
                @role('admin') Add OfferForm @endrole
            </a>



            {{--Start Popover--}}

            <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
               data-bs-container="body"
               data-bs-toggle="popover"
               data-bs-html="true"
               data-bs-content="<p>Click here to add a new OfferForm.</p>
               <br/><a href='#' class='openModalCreateOfferForm text-decoration-none text-dark'
               >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
               aria-hidden="true">
            </button>

            <!-- Modal -->



            <div class="modal fade" id="howToCreateOfferForm" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
{{--                 x-data="{isPlaying: false}"--}}
            >
                <div class="modal-dialog" style="max-width: 600px;">
                    <div class="modal-content">
                        <div class="modal-header border-0 text-center">
                            <button type="button"
                                    class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12"
                                    data-bs-dismiss="modal" aria-label="Close">X
                            </button>
                        </div>

                        <div class=" modal-body text-center px-lg-5 pt-0" style="margin-top: 15px"

                        >
                            <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                            <p class="text-primary-light fw-500">
                                You can also save forms from your team or shared forms from other OfferForm users.
                            </p>


{{--                            <div class="rounded-30 mt-2"--}}
{{--                                 x-show="!isPlaying"--}}
{{--                                 style="background-image: url({{asset('img/dash/offer-forms/how-much-to-offer.png')}});--}}
{{--                                     background-position: center; background-size: cover; background-repeat: no-repeat; height: 320px">--}}


{{--                                <div class="text-center text-white px-2 px-lg-5 py-2  d-flex align-items-center justify-content-center"--}}
{{--                                     style="height: 320px">--}}
{{--                                    <div>--}}
{{--                                        <h5 class="fw-normal d-none d-lg-block mb-2">Click here to learn more about</h5>--}}
{{--                                        <a--}}
{{--                                            href="javascript:void(0)"--}}
{{--                                            @click.prevent="isPlaying = true"--}}
{{--                                        >--}}
{{--                                            <i class="fa fa-play bg-white p-3 fs-16 text-center rounded-circle text-primary shadow"></i>--}}
{{--                                        </a>--}}
{{--                                        <h5 class="fw-normal d-none d-lg-block mt-2">Click Play</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}



                            <div class="first-time-user-popup-video"
{{--                                 @click.away="isPlaying = false; $('.stopVideoOnModalHide').trigger('pause');"--}}
                            >
                                <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                       controls>
                                    <source src="{{asset('video/offerform/how-to-create-offerform.mp4')}}"
                                            type="video/mp4">
                                </video>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{--End Popover--}}



            <div class="modal fade" id="createOfferFormModal" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="createOfferFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-30">
                        <div class="modal-header border-0 ms-auto pb-0 text-white">

                            <a href="javascript:void(0)"
                               class="text-decoration-none"
                               data-bs-dismiss="modal" aria-label="Close">
                                <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                            </a>

                            {{--                            <button class="btn-modal btn-primary-light-black-hover rounded-circle fs-12"--}}
                            {{--                                    data-bs-dismiss="modal"--}}
                            {{--                                    aria-label="Close">X--}}
                            {{--                            </button>--}}
                        </div>
                        <div class="modal-body d-grid gap-4 py-5">
                            <a
                                href="{{ route('dash.offer-forms.create') }}"
                                class="btn btn-lg btn-primary-light-black-hover py-3 fw-bold shadow-sm fs-14 rounded-pill text-uppercase"
                            >
                                Create Custom Form
                            </a>
                            @if(auth()->user()->is_part_of_a_team)
                                <a href="#"
                                   class="btn btn-lg btn-primary-light-black-hover py-3 fw-bold shadow-sm fs-14 rounded-pill text-uppercase"
                                   data-bs-toggle="modal" data-bs-target="#addTeamFormModal"
                                >Add Team Form</a>
                            @endif

                            <a href="#"
                               class="btn btn-lg btn-primary-light-black-hover py-3 fw-bold shadow-sm fs-14 rounded-pill text-uppercase"
                               data-bs-toggle="modal" data-bs-target="#addSharedFormModal"
                            >Add Shared Form</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:offer-forms.add-shared-form-modal/>
    <livewire:offer-forms.add-team-form-modal/>

    <div wire:sortable="changeSortOrder" id="offerforms">
        @foreach($offerForms as $offerForm)

            @if($displayAs === 'grid')
                <div wire:sortable.item="{{ $offerForm->id }}" class="card border-0 py-3 rounded-3 mb-4">
                    {{-- TODO need to sortable needs to fix for user only --}}
                    <a href="#" wire:sortable.handle class="text-center" style="cursor: grab"> <img
                            class="img-fluid xm-small-icon mx-auto" src="{{asset('img/form-builder/icons/grid.svg')}}"
                            alt=""></a>
                    <div class="card-body text-center">
                        <h3 class="text-primary-light fw-bold text-capitalize">
                            <a class="text-decoration-none"
                               href="{{ $offerForm->getPreviewLink(null, route('dash.offer-forms.index')) }}"> {{ $offerForm->name }}</a>

                            {{-- TODO need to add offer form images for shared, team and standards --}}

                            @if($offerForm->standard)
                                <img class="w-26 ms-1" src="{{asset('img/menu-icons/standard-forms.svg')}}" alt="">
                            @elseif($offerForm->source === 'universally-shared')
                                <img class="w-26 ms-1" src="{{asset('img/menu-icons/shared-form.svg')}}" alt="">
                            @elseif($offerForm->source === 'team-shared')
                                <img class="w-26 ms-1" src="{{asset('img/menu-icons/team-forms.svg')}}" alt="">
                            @endif

                        </h3>
                        <h5 class="text-dark fw-bold my-4 text-capitalize">{{ $offerForm->description }}</h5>

                        <div class="d-flex flex-column justify-content-center  flex-lg-row mb-3 ">
                            <div class="mx-3">
                                <p class="text-primary-light fw-bold fs-17">Created by: <span
                                        class="text-dark mx-1 text-capitalize fw-500">{{ $offerForm->createdBy ? $offerForm->createdBy->first_name : '' }}</span>
                                </p>
                            </div>

                            <div class="mx-3">
                                <p class="text-primary-light fw-bold fs-17">Last updated by:
                                    <span
                                        class="text-dark fw-500 mx-1">{{ $offerForm->lastUpdatedBy ? $offerForm->lastUpdatedBy->first_name : '' }} &nbsp;&nbsp;&nbsp{{ $offerForm->updated_at->timezone(session('ip_position:timezone', 'UTC'))->format('M d, Y h:i a') }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="btn-group btn-group-offer-form" role="group" aria-label="Basic example">
                            @hasanyrole('super-admin|admin')
                            <a href="#"
                               wire:click.prevent="activeOrInactive({{ $offerForm->id }})"
                               class="btn btn-lg w-150 rounded-pill fs-14  border me-3 my-2 my-lg-0 fs-16  btn-primary-light-black-hover">
                                <div wire:target="activeOrInactive({{ $offerForm->id }})" wire:loading>
                                    <x-spinner class="me-2"/>
                                </div>
                                <img src="{{asset('img/menu-icons/admin-icon/active-icon.svg')}}" class="w-17 me-2"
                                     alt="" wire:loading.remove
                                     wire:target="activeOrInactive({{ $offerForm->id }})"> {{ $offerForm->active ? 'Inactive' : 'Active' }}
                            </a>
                            @endhasanyrole
                            @role('agent')
                            <a href="#"
                               class="btn btn-lg w-150 rounded-pill fs-14 border me-3 my-2 my-lg-0 fs-16 dropdown btn-primary-light-black-hover"
                               id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div wire:target="copyLink('{{ $offerForm->slug }}')" wire:loading>
                                    <x-spinner class="me-2"/>
                                </div>
                                {{--                                <i class="fa fa-paper-plane pe-2" wire:target="copyLink('{{ $offerForm->slug }}')" wire:loading.remove></i>--}}
                                <img class="w-18 me-2" src="{{asset('img/menu-icons/send-form.svg')}}" alt=""
                                     wire:loading.remove
                                     wire:target="copyLink('{{ $offerForm->slug }}')"
                                >

                                Send Form
                            </a>

                            <ul class="dropdown-menu bg-primary-light border-0 rounded-3 mt-2 text-white py-0 "
                                aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item li-first-child text-white" href="#"
                                       wire:click.prevent="copyLink('{{ $offerForm->slug }}')"><i
                                            class="fa fa-link fs-18 mx-2"></i> Copy Link</a></li>
                                <li><a class="dropdown-item text-white" href="#" data-bs-toggle="modal"
                                       data-bs-target="#sendFormByPhone{{ $offerForm->id }}Modal"><i
                                            class="fa fa-mobile fs-22 mx-2"></i> Text Form</a></li>
                                <li><a class="dropdown-item li-last-child text-white" href="#" data-bs-toggle="modal"
                                       data-bs-target="#sendFormByEmail{{ $offerForm->id }}Modal"><i
                                            class="fa fa-envelope fs-18 mx-2"></i> Email Form</a></li>
                            </ul>
                            @endrole
                            @can('update', $offerForm)
                                <a href="{{ route('dash.offer-forms.edit', $offerForm->slug) }}"
                                   class="btn btn-lg w-150 rounded-pill fs-14  border me-3 my-2 my-lg-0 fs-16  btn-primary-light-black-hover">
                                    <img src="{{asset('img/menu-icons/admin-icon/edit-icon.svg')}}" class="w-17 me-2"
                                         alt="">Edit
                                </a>
                            @endcan
                            <a
                                class="btn btn-lg w-150 rounded-pill fs-14  border me-3 my-2 my-lg-0 fs-16  btn-primary-light-black-hover"
                                wire:click.prevent="duplicate({{ $offerForm->id }})">
                                <div wire:target="duplicate({{ $offerForm->id }})" wire:loading>
                                    <x-spinner class="me-2"/>
                                </div>
                                <img src="{{asset('img/menu-icons/admin-icon/duplicate-icon.svg')}}" class="w-17 me-2"
                                     alt="" wire:target="duplicate({{ $offerForm->id }})" wire:loading.remove> Duplicate
                            </a>
                            @can('delete', $offerForm)
                                <a
                                    class="btn btn-lg w-150 rounded-pill fs-14  border me-3 my-2 my-lg-0 fs-16  btn-primary-light-black-hover"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmation{{ $offerForm->id ?? 0 }}Modal">
                                    <img src="{{asset('img/menu-icons/admin-icon/delete.svg')}}" class="w-14 me-2"
                                         alt="">Delete
                                </a>
                            @endcan
                            <a href="{{ $offerForm->getViewFormLink(false, route('dash.offer-forms.index')) }}&clr"
                               class="btn btn-lg w-150 rounded-pill fs-14  border me-3 my-2 my-lg-0 fs-16
                                    @role('agent')btn-primary-lighter-black-hover @endrole
                               @role('admin')btn-primary-light-black-hover @endrole
                                   "><img src="{{asset('img/menu-icons/admin-icon/view.svg')}}" class="w-22 me-2"
                                          alt="">View Form</a>
                        </div>

                    </div>
                </div>
            @else
                @if($loop->index === 0)

                    <div class="mt-5">
                        <div class="card border-0 hover-border mb-3 bg-primary d-none d-lg-block">
                            <div class="card-body row text-center text-white">
                                <div class="col-12 col-lg-2 fw-bold">Form Name</div>
                                <div class="col-12 col-lg-3 fw-bold">Form Description</div>
                                <div class="col-12 col-lg-2 fw-bold">Template</div>
                                <div class="col-12 col-lg-2 fw-bold">Last Modified</div>
                                <div class="col-12 col-lg-2 fw-bold">Last Opened</div>
                                <div class="col-12 col-lg-1 fw-bold">Menu</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:sortable.item="{{ $offerForm->id }}" class="card border-0 mb-4">
                    {{-- TODO need to sortable needs to fix for user only --}}
                    <a href="#" wire:sortable.handle class="text-center d-block d-lg-none" style="cursor: grab"> <img
                            class="img-fluid xm-small-icon mx-auto" src="{{asset('img/form-builder/icons/grid.svg')}}"
                            alt="">
                    </a>
                    <div class="card-body">
                        <div class="row rounded-2 bg-white py-3 text-center">
                            <div class="col-12 col-lg-2 fw-bold text-primary text-capitalize text-md-start text-lg-start text-xl-start">
                                <a class="text-decoration-none d-inline-block text-truncate"
                                   href="{{ $offerForm->getViewFormLink(false, route('dash.offer-forms.index')) }}&clr" style="max-width: 165px;">
                                   <div style="width: 30px; display: inline-block">
                                        {{-- TODO need to add offer form images for shared, team and standards --}}
                                        @if($offerForm->standard)
                                            <img class="me-1 w-26" src="{{asset('img/menu-icons/standard-forms.svg')}}"
                                                 alt="">
                                        @elseif($offerForm->source === 'universally-shared')
                                            <img class="me-1 w-26" src="{{asset('img/menu-icons/shared-form.svg')}}" alt="">
                                        @elseif($offerForm->source === 'team-shared')
                                            <img class="me-1 w-26" src="{{asset('img/menu-icons/team-forms.svg')}}" alt="">
                                        @endif
                                   </div>
                                    {{ $offerForm->name }}
                                </a>

                            </div>
                            <div class="col-12 col-lg-3 ">
                                <span class=" d-inline-block text-truncate"
                                      style="max-width: 165px;">{{ $offerForm->description }}</span>
                            </div>
                            <div class="col-12 col-lg-2">
                                <a href="#" wire:sortable.handle class="text-center d-none d-lg-block"
                                   style="cursor: grab"> <img
                                        class="img-fluid xm-small-icon mx-auto"
                                        src="{{asset('img/form-builder/icons/grid.svg')}}"
                                        alt="">
                                </a>
                            </div>
                            <div
                                class="col-12 col-lg-2">{{ $offerForm->updated_at->timezone(session('ip_position:timezone', 'UTC'))->format('M d, Y h:i a') }}</div>
                            <div
                                class="col-12 col-lg-2">{{ $offerForm->updated_at->timezone(session('ip_position:timezone', 'UTC'))->format('M d, Y h:i a') }}</div>
                            <div class="col-12 col-lg-1   text-primary fw-bold">
                                <a class="px-2" href="#" id="showListData" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white "
                                    aria-labelledby="showListData">
                                    @can('update', $offerForm)
                                        <li>
                                            <a href="{{ route('dash.offer-forms.edit', $offerForm->slug) }}"
                                               class="dropdown-item text-dark tc-black-hover-warning fw-bold">
                                                Edit
                                            </a>
                                        </li>
                                    @endcan
                                    @role('agent')
                                    <li><a class="dropdown-item text-dark tc-black-hover-warning fw-bold" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#sendFormByEmail{{ $offerForm->id }}Modal">Email Form</a>
                                    </li>
                                    <li><a class="dropdown-item text-dark tc-black-hover-warning fw-bold" href="#"
                                           wire:click.prevent="$emit('copy-offerform-link', '{{ $offerForm->slug }}')">Copy
                                            Link
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item text-dark tc-black-hover-warning fw-bold" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#sendFormByPhone{{ $offerForm->id }}Modal">Text Form</a>
                                    </li>
                                    @endrole
                                    @can('delete', $offerForm)
                                        <li>
                                            <a class="dropdown-item text-dark tc-black-hover-warning fw-bold" href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#deleteConfirmation{{ $offerForm->id ?? 0 }}Modal"
                                            >Delete
                                            </a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a class="dropdown-item text-dark tc-black-hover-warning fw-bold" href="#"
                                           wire:click.prevent="duplicate({{ $offerForm->id }})">Duplicate
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-dark tc-black-hover-warning fw-bold"
                                           href="{{ $offerForm->getViewFormLink(false, route('dash.offer-forms.index')) }}&clr">View Form</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div wire:target="loadMore" wire:loading>
            <x-spinner class="me-2"/>
            Loading...
        </div>
    </div>
    @foreach($offerForms as $offerForm)
        <livewire:offer-forms.send-modal :by="'Email'" :offerForm="$offerForm" wire:key="{{ $loop->index . 'email' }}"/>
        <livewire:offer-forms.send-modal :by="'Phone'" :offerForm="$offerForm" wire:key="{{ $loop->index . 'phone' }}"/>
        <x-modals.delete-confirmation :id="$offerForm->id" :action='"destroy($offerForm->id)"'
                                      :key="time().$offerForm->id">

            <x-slot name="title">
                Are you sure you want to delete this form?
            </x-slot>

            <x-slot name="description">
                You would not be able to recover this!
            </x-slot>

        </x-modals.delete-confirmation>
    @endforeach
</div>

@push('scripts')
{{--    <script>--}}
{{--        $(function () {--}}
{{--            var h = $(window).height();--}}
{{--            document.addEventListener('drag', function (e) {--}}
{{--                var mousePosition = e.pageY - $(window).scrollTop();--}}
{{--                var topRegion = 220;--}}
{{--                var bottomRegion = h - 220;--}}
{{--                if (e.which === 1 && (mousePosition < topRegion || mousePosition > bottomRegion)) {    // e.wich = 1 => click down !--}}
{{--                    var distance = e.clientY - h / 2;--}}
{{--                    distance = distance * 0.1; // <- velocity--}}
{{--                    $(document).scrollTop(distance + $(document).scrollTop());--}}
{{--                } else {--}}
{{--                    $(document).unbind('mousemove');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <script type="text/javascript">
        {{--$(document).on('touchmove', onScroll); // for mobile--}}

        {{--function onScroll() {--}}
        {{--    var position = $(window).scrollTop();--}}
        {{--    var bottom = $(document).height() - $(window).height();--}}

        {{--    if (position < (bottom - 100) && position > (bottom - 200)) {--}}
        {{--        @this.loadMore()--}}
        {{--    }--}}
        {{--}--}}

        $(window).scroll(function () {

            var position = $(window).scrollTop();
            var bottom = $(document).height() - $(window).height();

            if (position < (bottom - 100) && position > (bottom - 200)) {
                @this.loadMore()
            }

        });
        {{--window.onscroll = function (ev) {--}}
        {{--    console.log((window.innerHeight + window.scrollY));--}}
        {{--    console.log($('#offerforms').offsetHeight());--}}
        {{--    console.log(document.body.offsetHeight);--}}
        {{--    if ((window.innerHeight + window.scrollY) > $('#offerforms').offsetHeight) {--}}
        {{--        // window.livewire.emit('load-more');--}}
        {{--        @this.loadMore()--}}
        {{--    }--}}
        {{--};--}}
    </script>

    <script>
        // $("#howToCreateOfferForm").on('hidden.bs.modal', function (e) {
        //     $("#howToCreateOfferForm video").attr("src", $("#howToCreateOfferForm video").attr("src"));
        // });

        $('#howToCreateOfferForm').on('hidden.bs.modal', function () {
            $('video').contents().find('video')[0].pause();
        });
    </script>

    <script>
        $(".btnStopVideoOnModalHide").click(function () {
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>

    </script>


        }<script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalCreateOfferForm', function(){
                $('#howToCreateOfferForm').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>

    <script>
        $(function () {
           window.livewire.on('edit-shared-space-forms', (forms) => {

               forms.forEach(function (form) {
                   console.log(form);
                   window.open(form);
                   window.focus();
               })
           })
        });
    </script>
@endpush
