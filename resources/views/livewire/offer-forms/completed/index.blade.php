<div class="container my-3 agent-completed-form-card">
    <div class="container header-container">
        @hasanyrole('super-admin|admin|agent')
        @php
            $teamSubscription = auth()->user()->subscription('premium-team-monthly');
            $team = auth()->user()->ownedTeams()->first();
        @endphp
        @if((($teamSubscription && $teamSubscription->valid()) || auth()->user()->current_team_id !== null) && ($team && $team->id === auth()->user()->current_team_id))
            <div class="mb-3">
                <a
                    href="#"
                    class="btn btn-lg rounded-pill  {{ $teamOffers === 'yes' ? 'bg-dark text-white active-svg-white' : 'btn-primary-light' }} btn-header fw-bold shadow-sm mx-1 px-4 fs-14 text-uppercase"
                    wire:click.prevent="viewTeamOffers"
                >
                    <div wire:target="viewTeamOffers" wire:loading>
                        <x-spinner class="me-2"/>
                    </div>
                    <img class=" mx-2" width="17" src="/img/menu-icons/fluent-people-white-icon.svg" alt="" wire:loading.remove
                         wire:target="viewTeamOffers" />
                    View Team Offers
                </a>
            </div>
        @endif
        @endhasanyrole
        <div class="row">
            <div class="form-group col-12 col-lg-5 my-1 ">
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
                    <x-input type="text" placeholder="Search Offers by Address or Buyers Name"
                             aria-describedby="button-addon4"
                             class="form-control form-control-lg rounded-pill bg-none border-0 search"
                             wire:model.debounce.500ms="search"/>
                </div>
            </div>
            <div class="form-group col-12 col-lg-7 my-1 btn-group">
                @hasanyrole('super-admin|admin|agent')

                {{--                <a href="#" wire:click.prevent="$set('archived', {{ !$archived }})"--}}
                {{--                   class="btn btn-white-black-hover rounded-pill btn-header btn-hover-white-img" style="font-size: 13px">--}}
                {{--                    <img class="me-2" width="15" src="/img/agent/icons/trash.svg" alt=""> Archive--}}
                {{--                </a>--}}

                {{--                <a href="#"--}}
                {{--                   wire:click.prevent="$set('archived', {{ !$archived }})"--}}
                {{--                   class="btn btn-lg btn-white-black-hover btn-hover-white-img rounded-pill btn-header--}}
                {{--                    fw-bold shadow-sm px-2 fs-14" style="font-size: 13px">--}}
                {{--                    <img class="me-2" width="15" src="/img/agent/icons/trash.svg" alt=""> Archive--}}
                {{--                </a>--}}


                <a href="#" wire:click.prevent="$set('archived', {{ $archived ? 0 : 1 }})"
                   class="btn {{ $archived ? 'bg-primary text-white active-svg-white' : '' }}
                       btn btn-lg btn-white-black-hover btn-hover-white-img rounded-pill btn-header fw-bold shadow-sm px-2 fs-14">
                    <img class=" me-2" width="15" src="/img/agent/icons/trash.svg" alt=""> Archive
                </a>

                @endhasanyrole
                <a href="#" class="btn btn-lg btn-white-black-hover btn-hover-white-img rounded-pill btn-header fw-bold shadow-sm ms-3 px-2 fs-14"
                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 13px"
                >
                    <div wire:target="changeSortBy" wire:loading>
                        <x-spinner class="me-2"/>
                    </div>
                    <span class="text-muted me-1" wire:target="changeSortBy" wire:loading.remove>Sort:</span> {{ str_replace('_', ' ', Str::title($sortBy)) }}
                    <img src="{{asset('img/menu-icons/arrow-dropdown-down.svg')}}" class="w-12 ms-2" alt="">
                </a>

                <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white py-0"
                    aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a
                            class="dropdown-item {{ $sortBy === 'a_z' ? 'active' : 'text-dark' }} fw-500 fs-14"
                            wire:click.prevent="changeSortBy('a_z')"
                            href="#"
                        >
                            A-Z
                        </a>
                    </li>
                    <li>
                        <a
                            class="dropdown-item {{ $sortBy === 'new' ? 'active' : 'text-dark' }} fw-500 fs-14"
                            wire:click.prevent="changeSortBy('new')"
                            href="#"
                        >
                            NEW
                        </a>
                    </li>
                    <li>
                        <a
                            class="dropdown-item {{ $sortBy === 'last_opened' ? 'active' : 'text-dark' }} fw-500 fs-14"
                            wire:click.prevent="changeSortBy('last_opened')"
                            href="#"
                        >
                            Last Opened
                        </a>
                    </li>
                    <li>
                        <a
                            class="dropdown-item {{ $sortBy === 'date_submitted' ? 'active' : 'text-dark' }} fw-500 fs-14"
                            wire:click.prevent="changeSortBy('date_submitted')"
                            href="#"
                        >
                            Date Submitted
                        </a>
                    </li>
                    <li>
                        <a
                            class="dropdown-item li-last-child {{ $sortBy === 'accepted_offers' ? 'active' : 'text-dark' }} fw-500 fs-14"
                            wire:click.prevent="changeSortBy('accepted_offers')"
                            href="#"
                        >
                            Accepted Offers
                        </a>
                    </li>
                </ul>

                <a href="#" class="btn btn-lg btn-white-black-hover btn-hover-white-img rounded-pill btn-header fw-bold shadow-sm ms-3 px-2 fs-14"
                   id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 13px"
                >
                    @switch($displayAs)
                        @case('grid')
                        <img class=" me-2" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt=""/> Grid
                        @break
                        @case('list')
                        <img class=" me-2" width="15" src="{{asset('img/agent/icons/list.svg')}}" alt=""/> List
                        @break
                        @case('compact')
                        <img class=" me-2" width="15" src="{{asset('img/agent/icons/compact.svg')}}" alt=""/> Compact
                        @break
                    @endswitch

                    <img src="{{asset('img/menu-icons/arrow-dropdown-down.svg')}}" class="w-12 ms-2" alt="">
                </a>

                <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white py-0"
                    aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item li-first-child text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('grid')"
                           href="#">
                            <img class=" me-3" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt="">Grid</a>
                    </li>
                    <li><a class="dropdown-item text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('list')"
                           href="#">
                            <img class=" me-3" width="15" src="{{asset('img/agent/icons/list.svg')}}" alt="">List</a>
                    </li>
                    <li><a class="dropdown-item li-last-child text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('compact')"
                           href="#">
                            <img class=" me-3" width="15" src="{{asset('img/agent/icons/compact.svg')}}" alt="">Compact</a>
                    </li>
                </ul>
                @hasanyrole('super-admin|admin|agent')
                <a href="{{route('dash.categories')}}"
                   class="btn btn-lg btn-primary-light-black-hover rounded-pill btn-header fw-bold shadow-sm ms-3 px-2 fs-14" style="font-size: 13px">
                    <img class="me-2 w-15" src="/img/agent/icons/category.svg" alt=""> Form Categories
                </a>
                @endhasanyrole



                {{--Start Popover--}}

                <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                        data-bs-container="body"
                        data-bs-toggle="popover"
                        data-bs-html="true"
                   data-bs-content="<p>Categories dictate what order information shows up...</p>
                   <a href='#' class='openModalOfferFormCategories text-decoration-none text-dark'
                   >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                   aria-hidden="true">
                </button>

                <!-- Modal -->
                <div class="modal fade" id="formCategories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
{{--                     x-data="{isPlaying: false}"--}}
                >
                    <div class="modal-dialog" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header border-0 text-center">
                                <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                                </button>
                            </div>


                            <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                            >
                                <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                                <p class="text-primary-light fw-500">
                                    Categories dictate what order information shows up on your summary page. You can rearrange them in whatever order you would like or create new categories.

                                </p>

                                <div class="first-time-user-popup-video">
                                    <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                           controls>
                                        <source src="{{asset('video/offerform/form-categories.mp4')}}" type="video/mp4">
                                    </video>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>

                {{--End Popover--}}


            </div>
        </div>
    </div>
    @if($displayAs === 'grid')
        <div class="row my-5">
            @foreach($offers as $offer)
                @php
                    $variables = $offer->variables ?? [];
                @endphp
                <div class="col-12 col-md-6 col-lg-4 mb-5">
                    <div class="card rounded-3 border-0 m-2" >
                        <a class="text-decoration-none"
                           href="{{ route('dash.offer-forms.completed.show', $offer->slug) }}">
                            <img class="img-fluid" src="{{asset('img/agent/completed-offerforms/cof1.png')}}" alt="">
                        </a>
                        <div class="card-body p-3">
                            <h5 class="text-primary-light">
                                <a class="text-decoration-none"
                                   href="{{ route('dash.offer-forms.completed.show', $offer->slug) }}">
                                    {{ $variables[\App\Models\OfferForms\OfferFormOffer::VAR_PROPERTY_ADDRESS] ?? $variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_ADDRESS] ?? '' }}
                                </a>
                            </h5>

                            <div class="d-flex flex-column flex-lg-row my-3">
                                @if($offer->created_at->format('Y-m-d') === \Carbon\Carbon::today()->format('Y-m-d'))
                                    <div class="me-3">
                                            <p class="bg-light rounded-pill px-2 py-1 fs-12 text-uppercase fw-bold">
                                                <img src="{{asset('img/menu-icons/red-bell-icon.svg')}}" class="w-14 me-1" alt="">
                                                NEW</p>
                                    </div>
                                @endif
                                <div class="">
                                    <p class="py-1 fw-400">Submitted: <span
                                            class="ms-3 fw-bolder">{{ $offer->created_at->format('m/d/y @ h:i A') }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="px-0" style="min-height: 100px">

                                @if(isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_BUYER_FIRST_NAME]) || isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_FIRST_NAME]) )
                                    <div class="row mb-2">
                                        <div class="col-5">
                                            <p class="mb-0 fw-400">Buyer:</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="mb-0 text-primary-light text-capitalize fw-bold">
                                                {{ $variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_FIRST_NAME] ?? $variables[\App\Models\OfferForms\OfferFormOffer::VAR_BUYER_FIRST_NAME] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_OFFER_AMOUNT]))
                                    <div class="row mb-2">
                                        <div class="col-5">
                                            <p class="mb-0 fw-400">Offer Amount:</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="mb-0 fw-bold">
                                                ${{ number_format($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_OFFER_AMOUNT] ?? 0) }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_DOWN_PAYMENT]))
                                    <div class="row mb-2">
                                        <div class="col-5">
                                            <p class="mb-0 fw-400">Down payment:</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="mb-0 fw-bold">
                                                ${{ number_format($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_DOWN_PAYMENT] ?? 0) }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="d-flex justify-content-between mt-5 ">
                                <div class="align-self-end">
                                    <div class="form-check ">
                                        <input class="form-check-input border-primary-light" type="checkbox"
                                               id="offerAccepted{{ $offer->id }}" style="width: 20px;height: 20px"
                                               {{ $offer->accepted ? 'checked' : '' }} wire:change="onChangeOffer({{ $offer->id }}, 'accepted', {{ $offer->accepted ? 0 : 1}})">
                                        <label class="form-check-label fs-12 fw-bold pt-1 ms-2"
                                               for="offerAccepted{{ $offer->id }}">
                                            Offer Accepted
                                        </label>
                                    </div>
                                </div>
                                <div class="align-self-end">
                                    <a href="#" class="fs-12 fw-bold text-decoration-none btn-dark-hover-primary-light"
                                       wire:click.prevent="onChangeOffer({{ $offer->id }}, 'archived', {{ $offer->archived ? 0 : 1 }})">
                                        <img
                                            class="mx-2" width="15" src="{{asset('img/agent/icons/trash.svg')}}"
                                            alt=""
                                        />
                                         {{$offer->archived == 0 ? 'Archive' : 'Unarchive'}}
                                    </a>
                                </div>
{{--                                <div class="outer-border rounded-circle align-self-end">--}}
{{--                                    <div--}}
{{--                                        class="inner-border border-warning rounded-circle d-flex align-items-center justify-content-center">--}}
{{--                                        <p class="mb-0 fw-bold fs-14">--}}
{{--                                            Closing <br/> 08.03.2021--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif($displayAs === 'list')
       <div class="my-5">
           @foreach($offers as $offer)
               @php
                   $variables = $offer->variables ?? [];
               @endphp
               <div class="card border-0 mb-3">
                   <div class="row card-body">
                       <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center">
                           <div class="fw-bold d-flex justify-content-start mb-2">
                               <a href="{{ route('dash.offer-forms.completed.show', $offer->slug) }}" class="text-decoration-none text-dark fs-16">
                                   {{ $variables[\App\Models\OfferForms\OfferFormOffer::VAR_PROPERTY_ADDRESS] ?? $variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_ADDRESS] ?? '' }}
                               </a>
                               @if($offer->created_at->format('Y-m-d') === \Carbon\Carbon::today()->format('Y-m-d'))
                                   <span class=" bg-light rounded-pill px-2 py-1 ms-2 text-uppercase fw-bold">
                                           <img src="{{asset('img/menu-icons/red-bell-icon.svg')}}" class="w-14 me-2" alt="">NEW
                                   </span>
                               @endif
                           </div>
                           <div class="d-flex justify-content-between">
                               <div>
                                   @if(isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_BUYER_FIRST_NAME]) || isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_FIRST_NAME]) )
                                       <p class="fs-12 mb-0">Buyer</p>
                                       <p class="fs-12 mb-0 fw-bold">
                                           {{ $variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_FIRST_NAME] ?? $variables[\App\Models\OfferForms\OfferFormOffer::VAR_BUYER_FIRST_NAME] ?? '' }}
                                       </p>
                                   @endif
                               </div>
                               <div>
                                   @if(isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_OFFER_AMOUNT]))
                                       <p class="fs-12 mb-0">Offer Amount</p>
                                       <p class="fs-12 mb-0 fw-bold">${{ number_format($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_OFFER_AMOUNT] ?? 0) }}</p>
                                    @endif
                               </div>
                               <div>
                                   @if(isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_DOWN_PAYMENT]))
                                       <p class="fs-12 mb-0">Down payment</p>
                                       <p class="fs-12 mb-0 fw-bold">${{ number_format($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_DOWN_PAYMENT] ?? 0) }}</p>
                                   @endif
                               </div>
                           </div>
                       </div>
                       <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-center ">
{{--                           <div--}}
{{--                               class="inner-border border-warning mx-auto rounded-circle d-flex align-items-center justify-content-center">--}}
{{--                               <p class="mb-0 fw-bold fs-14">--}}
{{--                                   Closing </br>08.03.2021--}}
{{--                               </p>--}}
{{--                           </div>--}}
                       </div>
                       <div
                           class="col-12 col-lg-4 my-3 my-lg-0 align-self-center d-grid justify-content-start justify-content-lg-end">
                           <p class="">Submitted: <b
                                   class="mx-2">{{ $offer->created_at->format('m/d/y @ h:i A') }}</b></p>

                           <div class="form-check">
                               <input class="form-check-input border-primary-light" type="checkbox" style="width: 18px;height: 18px"
                                      id="offerAccepted{{ $offer->id }}"
                                      {{ $offer->accepted ? 'checked' : '' }} wire:change="onChangeOffer({{ $offer->id }}, 'accepted', {{ $offer->accepted ? 0 : 1}})">
                               <label class="form-check-label fs-12 ms-2 fw-bold" for="offerAccepted{{ $offer->id }}">
                                   Offer Accepted
                               </label>
                           </div>
                           <a href="#"
                              wire:click.prevent="onChangeOffer({{ $offer->id }}, 'archived', {{ $offer->archived ? 0 : 1 }})"
                              class="text-decoration-none text-dark mt-2"
                           >
                               <img src="{{asset('img/agent/icons/trash.svg')}}" alt=""> <b class="mx-2">Archive</b>
                           </a>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>
    @else
        <div class="card border-0 my-5">
            <div class="card-body table-responsive">
                <table class="table table-borderless ">
                    <thead>
                    <tr class="border-bottom">
                        <th scope="col">Client Name(s)<img class="w-12 ms-2" src="{{asset('img/menu-icons/double-arrow.svg')}}" alt=""></th>
                        <th scope="col">Property Address<img class="w-12 ms-2" src="{{asset('img/menu-icons/double-arrow.svg')}}" alt=""></th>
                        <th scope="col">Offer Amount<img class="w-12 ms-2" src="{{asset('img/menu-icons/double-arrow.svg')}}" alt=""></th>
                        <th scope="col">Down Payment<img class="w-12 ms-2" src="{{asset('img/menu-icons/double-arrow.svg')}}" alt=""></th>
                        <th scope="col">Submission Date<img class="w-12 ms-2" src="{{asset('img/menu-icons/double-arrow.svg')}}" alt=""></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                        @php
                            $variables = $offer->variables ?? [];
                        @endphp
                        <tr>
                            <td class="fw-500">
                                {{ $variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_FIRST_NAME] ?? $variables[\App\Models\OfferForms\OfferFormOffer::VAR_BUYER_FIRST_NAME] ?? '' }}</td>
                            <td class="fw-500">{{ $variables[\App\Models\OfferForms\OfferFormOffer::VAR_PROPERTY_ADDRESS] ?? $variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_ADDRESS] ?? '' }}</td>

                            <td class="fw-500">
                                 @if(isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_OFFER_AMOUNT]))
                                    ${{ number_format($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_OFFER_AMOUNT] ?? 0) }}
                                @endif
                            </td>

                            <td class="fw-500">
                                @if(isset($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_DOWN_PAYMENT]))
                                     ${{ number_format($variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_CALCULATOR_DOWN_PAYMENT] ?? 0) }}
                                @endif
                            </td>

                            <td class="fw-500">{{ $offer->created_at->format('m/d/y @ h:i A') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

@push('scripts')


    <script>
        $(".btnStopVideoOnModalHide").click(function(){
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalOfferFormCategories', function(){
                $('#formCategories').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>

@endpush
