<div>
    @if($displayAs === 'grid')
        <div class="row BlockLayout" wire:key="rfstg{{ time() }}" x-data>
            @foreach($referralPartnerTypes as $referralPartnerType)
                <div
                    id="rt-{{ $referralPartnerType->id }}"
                    data-id="{{ $referralPartnerType->id }}"
                    class="col-12 col-md-6 col-lg-4 mb-5 draggable-partner-type"  wire:key="{{$referralPartnerType->id}}"
                    x-on:dragstart.self="
                            console.log(event.target.getAttribute('data-id'));
                            dragging = true;
                            event.dataTransfer.effectAllowed='move';
                            event.dataTransfer.setData('text/plain', event.target.getAttribute('data-id'));
                        "
                    x-on:dragend="dragging = false"
                    x-data="{ dragging: false }"
                    draggable="true"
                >
                    <div class="card rounded-3 shadow-sm hover-border offerFormCardGrid">
                        <div class="card-img-top d-flex justify-content-center align-items-center"
                             style="background-color: #d5b6ed; height: 280px">
                            <h1 class="mb-0 fw-bolder text-white text-center">{{ $referralPartnerType->name }}</h1>
                        </div>
                        <div class="card-body bg-white"
                             style="border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                            <div class="row align-items-center mt-3 rounded-3 stepsGrid">
                                <div class="col-5 align-items-center">
                                    <a
                                        href="#"
                                        class="text-decoration-none me-2 text-muted"
                                        data-bs-toggle="modal"
                                        @if($referralPartnerType->need_to_upgrade)
                                            data-bs-target="#upgradeToPremiumModal"
                                        @else
                                            data-bs-target="#deleteConfirmation{{ $referralPartnerType->id ?? 0 }}Modal"
                                        @endif
                                    >
                                        <img class="w-17 svgIcon"
                                             src="{{asset('img/dash/offer-forms/delete-gray-icon.svg')}}"
                                             alt="">
                                    </a>
{{--                                    <a--}}
{{--                                        href="#" class="text-decoration-none me-2 text-muted"--}}
{{--                                        wire:click.prevent="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})"--}}
{{--                                    >--}}
{{--                                        <div wire:loading wire:target="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})">--}}
{{--                                            <x-spinner />--}}
{{--                                        </div>--}}
{{--                                        <img class="w-17"--}}
{{--                                             src="{{asset('img/menu-icons/library-step-'.($step->active ? 'active' : 'inactive').'.svg')}}"--}}
{{--                                             alt="" wire:loading.remove wire:target="toggleStepActive({{ $step->id }}, {{ $step->active ? 0 : 1 }})" />--}}
{{--                                    </a>--}}
                                </div>
                                <div class="col-2 text-center">
                                    <img src="{{asset('img/dash/offer-forms/grid-gray-icon.svg')}}" class="w-26" alt="" style="cursor: pointer" draggable="false" />
                                </div>
                                <div class="col-5 text-end">
                                    <div class="mb-0 text-muted d-flex align-items-center justify-content-end">
                                        <img
                                            src="{{ asset('logo/iconic.png') }}"
                                            class="me-2"
                                            alt="{{ $referralPartnerType->name }}"
                                            style="height: 30px"
                                            draggable="false"
                                        />
                                        <div class="fw-bold">
                                            Step {{ $referralPartnerType->pivot->display_order !== 100000 ? $referralPartnerType->pivot->display_order + 1 : $loop->iteration  }}
                                            @unlessrole('agent')
                                                <a
                                                    href="#" class="text-decoration-none me-2 text-muted"
                                                    wire:click.prevent="toggleStepLocked({{ $referralPartnerType->id }}, {{ $referralPartnerType->locked ? 0 : 1 }})"
                                                >
                                                    <div wire:loading
                                                         wire:target="toggleStepLocked({{ $referralPartnerType->id }}, {{ $referralPartnerType->locked ? 0 : 1 }})">
                                                        <x-spinner style="height: 13px; width: 13px"/>
                                                    </div>
                                                    <i class="fa fa-lock {{ $referralPartnerType->locked ? 'text-primary' : '' }} ms-2 fs-18"
                                                       aria-hidden="true" wire:loading.remove
                                                       wire:target="toggleStepLocked({{ $referralPartnerType->id }}, {{ $referralPartnerType->locked ? 0 : 1 }})"></i>
                                                </a>
                                            @else
                                                @if($referralPartnerType->need_to_upgrade)
                                                    <i class="fa fa-lock text-primary ms-2 fs-18" aria-hidden="true"></i>
                                                @endif
                                            @endunlessrole
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div wire:sortable="changeSortOrder" wire:key="rfstng{{ time() }}">
            <div class="card border-0 mb-3 py-3 bg-primary d-none d-lg-block">
                <div class="card-body p-0">
                    <div class="row text-white rounded-2 text-center">
                        <div class="col-12 col-lg-2 fw-bold">Step Order</div>
                        <div class="col-12 col-lg-3 fw-bold">Step Name</div>
                        <div class="col-12 col-lg-2 fw-bold">Template</div>
                        <div class="col-12 col-lg-2 fw-bold">Last Modified</div>
                        <div class="col-12 col-lg-1 fw-bold">Menu</div>
                    </div>
                </div>
            </div>

            <div>
                @foreach($referralPartnerTypes as $referralPartnerType)
                    <div class="card border-0 hover-border mb-3 py-3" >
                        <div class="card-body row text-center">
                            <div class="col-12 col-lg-2 mb-3 mb-lg-0 fw-bold text-muted">
                                Step Order: {{ $referralPartnerType->pivot->display_order !== 100000 ? $referralPartnerType->pivot->display_order + 1 : $loop->iteration  }}
                                @unlessrole('agent')
                                    <a
                                        href="#" class="text-decoration-none me-2 text-muted"
                                        wire:click.prevent="toggleStepLocked({{ $referralPartnerType->id }}, {{ $referralPartnerType->locked ? 0 : 1 }})"
                                    >
                                        <i class="fa fa-lock {{ $referralPartnerType->locked ? 'text-primary' : '' }} ms-2 fs-18"
                                           aria-hidden="true"></i>
                                    </a>
                                @else
                                    @if($referralPartnerType->need_to_upgrade)
                                        <i class="fa fa-lock text-primary ms-2 fs-18" aria-hidden="true"></i>
                                    @endif
                                @endunlessrole
                            </div>
                            <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                <a class="text-decoration-none fw-bold text-capitalize d-inline-block text-truncate"
                                   style="max-width: 200px;"
                                   href="#"
                                >


                                        <img class="img-fluid small-icon"
                                             src="{{asset('img/form-builder/icons/offer_form_logo.png')}}"
                                             alt=""/>

                                    {{ $referralPartnerType->name }}
                                </a>
                            </div>
                            <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                            </div>
                            <div class="col-12 col-lg-2 mb-3 mb-lg-0">{{ $referralPartnerType->updated_at->timezone(session('ip_position:timezone', 'UTC'))->format('M d, Y h:i a') }}</div>
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
                                            @if($referralPartnerType->need_to_upgrade)
                                                data-bs-target="#upgradeToPremiumModal"
                                            @else
                                                data-bs-target="#deleteConfirmation{{ $referralPartnerType->id ?? 0 }}Modal"
                                            @endif

                                        ><i class="fa fa-trash fs-16 mx-2"></i>Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @foreach($referralPartnerTypes as $referralPartnerType)
        <x-modals.delete-confirmation :id="$referralPartnerType->id" :action='"destroy($referralPartnerType->id)"'
                                      :key="time().$referralPartnerType->id">

            <x-slot name="title">
                Are you sure you want to delete this referral partner type?
            </x-slot>

            <x-slot name="description">
                You would not be able to recover this!
            </x-slot>

        </x-modals.delete-confirmation>

    @endforeach

    @push('scripts')
            <script>
                // var el = document.querySelectorAll('div.BlockLayout');
                // var droppable = new window.Draggable.Droppable(el, {
                //     draggable: '.draggable-partner-type',
                //     dropzone: '.droppable-zone-for-partner-type',
                //     mirror: {
                //         constrainDimensions: true,
                //     },
                // });
                // let droppableOrigin;
                //
                // // --- Draggable events --- //
                // droppable.on('drag:start', (evt) => {
                //     droppableOrigin = evt.originalSource.parentNode.dataset.dropzone;
                //     console.log(droppableOrigin)
                // });
                //
                // droppable.on('droppable:dropped', (evt) => {
                //     if (droppableOrigin !== evt.dropzone.dataset.dropzone) {
                //         evt.cancel();
                //     }
                //     console.log(droppableOrigin)
                // });
                // draggable.on('drag:start', () => {  });
                // draggable.on('drag:over', () => {
                //     object_over = draggable.currentOver;
                //     console.log(object_over)
                // });
                // draggable.on('drag:stop', () => {
                //    console.log('stop')
                // });
                // draggable.on('drag:out', () => {
                //     over = false;
                // });
            </script>
    @endpush
</div>
