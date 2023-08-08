<div>
    <div class="container header-container my-3">
        @if(!$isPdfMode)
            <div class="d-flex flex-column flex-lg-row justify-content-between">

                <a href="{{ route('dash.offer-forms.completed') }}"
                   class="btn btn-lg mb-3 mb-lg-0 btn-white-black-hover rounded-pill btn-header fw-bold shadow-sm px-3 fs-14">
                    <i class="fa fa-angle-left me-3 fs-16"></i> Back to my offers
                </a>

                <a href="#"
                   class="btn btn-lg mb-3 mb-lg-0 btn-white-black-hover btn-hover-white-img rounded-pill btn-header fw-bold shadow-sm  px-x fs-14"
                   id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div wire:target="exportToEmail,exportToZapier" wire:loading>
                        <x-spinner class="me-2"/>
                    </div>
                    <img class=" mx-2" width="15" src="{{asset('img/agent/icons/export.svg')}}" alt=""
                         wire:target="exportToEmail,exportToZapier" wire:loading.remove/>
                    Export To...
                </a>

                <ul class="dropdown-menu bg-white border-0 rounded-15 mt-2 text-white shadow py-0"
                    aria-labelledby="dropdownMenuButton1">
                    <li class=""><a href="{{ route('dash.offer-forms.completed.pdf', [$offerFormOffer->slug, 'fte' => implode(',', $fieldsToExport)]) }}"
                                    class="dropdown-item text-dark li-first-child fw-500 fs-14" target="_blank"><img
                                src="{{asset('img/menu-icons/download.svg')}}" class="w-16 me-2" alt="">Download PDF</a>
                    </li>
                    <li class="my-1"><a class="dropdown-item text-dark fw-500 fs-14" data-bs-toggle="modal"
                                        data-bs-target="#exportEmailModal" href="#"><img
                                src="{{asset('img/menu-icons/email.svg')}}" class="w-16 me-2" alt="">Email</a></li>
                    <li class=""><a wire:click.prevent="exportToZapier"
                                    class="dropdown-item text-dark li-last-child fw-500 fs-14" href="#"><img
                                src="{{ asset('img/menu-icons/zapier.svg') }}" class="w-16 me-2" alt="">Zapier</a></li>
                </ul>
            </div>
            <hr>
        @else
            <div class="d-flex">
                <img src="{{ public_path('logo/horizontal.png') }}" class="mx-auto" width="400"/>
            </div>
        @endif
    </div>
    @if(!$isPdfMode)
        <div wire:ignore.self class="modal hideableModal fade" id="exportEmailModal"
             data-bs-backdrop="static"
             data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="exportEmailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-3">
                    <div class="row modal-header border-0">
                        <div class="col-8">
                            <h5 class="mb-0 text-primary">Export to Email</h5>
                        </div>
                        <div class="col-4 text-end">
                            <a href="javascript:void(0)"
                               class="text-decoration-none"
                               data-bs-dismiss="modal" aria-label="Close">
                                <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                            </a>
                        </div>

                    </div>

                    <form class="modal-body" wire:submit.prevent="exportToEmail"
                          wire:key="exportToEmail{{uniqid()}}">
                        <x-input
                            id="email"
                            name="emailToExport"
                            placeholder="Enter email here..."
                            wire:model.defer="emailToExport"
                            required
                        />
                        <div class="d-flex mt-3">
                            <x-button type="submit" class="btn-primary ms-auto mt-2">
                                <div wire:loading.remove wire:target="exportToEmail">
                                    Export
                                </div>
                                <div wire:loading wire:target="exportToEmail">
                                    Exporting...
                                </div>
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <livewire:offer-forms.summary
        view-type="agent"
        :offer-form="$offerFormOffer->offerForm"
        :offer="$offerFormOffer"
        :is-pdf-mode="$isPdfMode"
    />
    <div class="container">
        <div class="card rounded-3 border-0 shadow my-5" x-data="">
            <div class="card-body">
                <div class="row mb-4 mt-2">
                    @if($offerFormOffer && $offerFormOffer->textSignature() !== null)
                        <div class="col-12 col-md-6 col-lg-5 mb-3 mb-lg-0 mx-auto">
                            <div class="row">
                                <div class="col-8 px-0 align-self-center">
                                    <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD50">
                                        <h4 class="text-dark mb-0 text-center btn-signature fw-bold">
                                            {{ $offerFormOffer && $offerFormOffer->textSignature() !== null ? $offerFormOffer->textSignature() : 'Click here to type signature' }}
                                        </h4>
                                    </div>
                                </div>

                                <div class="col-4 px-0 align-self-center">
                                    <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD80">
                                        <div>
                                            <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                                            @if($offerFormOffer && $offerFormOffer->textSignature() !== null && $offerFormOffer->signed_at !== null)
                                                <p class="mb-0 fs-10 text-dark fw-bold">{{ $offerFormOffer->signed_at->format('m/d/y g:i A') }}</p>
                                            @else
                                                <p class="mb-0 fs-10 text-dark fw-bold text-center">--/--/-- --:-- --</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12 col-md-6 col-lg-5 mb-3 mb-lg-0 mx-auto">
                            <div class="row">
                                <div class="col-8 px-0 align-self-center">
                                    <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD50">
                                        @if($offerFormOffer && $offerFormOffer->pngSignature() !== null)
                                            <img src="{{ $offerFormOffer->pngSignature()  }}" style="height: 50px !important;"/>
                                        @else
                                            <h4 class="text-dark mb-0 text-center btn-signature fw-bold">Click here to draw signature</h4>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4 px-0 align-self-center">
                                    <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD80">
                                        <div>
                                            <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                                            @if($offerFormOffer && $offerFormOffer->pngSignature() !== null && $offerFormOffer->signed_at !== null)
                                                <p class="mb-0 fs-10 text-dark fw-bold">{{ $offerFormOffer->signed_at->timezone(session('ip_position:timezone', 'UTC'))->format('m/d/y g:i A') }}</p>
                                            @else
                                                <p class="mb-0 fs-10 text-dark fw-bold text-center">--/--/-- --:-- --</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($offerFormOffer && ($offerFormOffer->getVariable(\App\Models\OfferForms\OfferFormOffer::VAR_ADDITIONAL_BUYER_FIRST_NAME) !== '' || $offerFormOffer->getVariable(\App\Models\OfferForms\OfferFormOffer::VAR_ADDITIONAL_BUYER_LAST_NAME) !== ''))
                       @if($offerFormOffer && $offerFormOffer->textSignature2() !== null)
                            <div class="col-12 col-md-6 col-lg-5 mb-3 mb-lg-0 mx-auto">
                                <div class="row">
                                    <div class="col-8 px-0 align-self-center">
                                        <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD50">
                                            <h4 class="text-dark mb-0 text-center btn-signature fw-bold">
                                                {{ $offerFormOffer && $offerFormOffer->textSignature2() !== null ? $offerFormOffer->textSignature2() : 'Click here to type signature' }}
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="col-4 px-0 align-self-center">
                                        <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD80">
                                            <div>
                                                <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                                                @if($offerFormOffer && $offerFormOffer->textSignature2() !== null && $offerFormOffer->signed_at_2 !== null)
                                                    <p class="mb-0 fs-10 text-dark fw-bold">{{ $offerFormOffer->signed_at_2->timezone(session('ip_position:timezone', 'UTC'))->format('m/d/y g:i A') }}</p>
                                                @else
                                                    <p class="mb-0 fs-10 text-dark fw-bold text-center">--/--/-- --:-- --</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-md-6 col-lg-5 mb-3 mb-lg-0 mx-auto">
                                <div class="row">
                                    <div class="col-8 px-0 align-self-center">
                                        <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD50">
                                            @if($offerFormOffer && $offerFormOffer->pngSignature2() !== null)
                                                <img src="{{ $offerFormOffer->pngSignature2()  }}" style="height: 50px !important;"/>
                                            @else
                                                <h4 class="text-dark mb-0 text-center btn-signature fw-bold">Click here to draw signature</h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4 px-0 align-self-center">
                                        <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD80">
                                            <div>
                                                <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                                                @if($offerFormOffer && $offerFormOffer->pngSignature2() !== null && $offerFormOffer->signed_at_2 !== null)
                                                    <p class="mb-0 fs-10 text-dark fw-bold">{{ $offerFormOffer->signed_at_2->format('m/d/y g:i A') }}</p>
                                                @else
                                                    <p class="mb-0 fs-10 text-dark fw-bold text-center">--/--/-- --:-- --</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#toggleAllCheckbox').trigger('click');
            });
        </script>
    @endpush
</div>
