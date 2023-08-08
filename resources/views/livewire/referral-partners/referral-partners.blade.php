
<div>

    <div class="container mt-3 mb-5 ">

        <h2 class="text-center mb-5 text-capitalize">{{$referralPartnerType->name}}</h2>

        <a href="#"
           wire:click.prevent="edit"
           class="btn btn-lg btn-primary-lighter-black-hover rounded-pill btn-header fw-400 shadow-sm mx-1 px-4 fs-14 mb-3 text-uppercase btn-sm-100">
            CHANGE REFERRAL TYPE NAME
        </a>

        <!-- Modal -->
        <div class="modal fade" id="ReferralPartnerTypeForm" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header border-0 ms-auto pb-0">
                        <a href="javascript:void(0)"
                           class="text-decoration-none"
                           data-bs-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('img/menu-icons/cross-icon.svg') }}"
                                 class="w-30 svg-hover-black" alt="">
                        </a>
                    </div>

                    <h4 class="modal-title text-center text-capitalize" id="staticBackdropLabel">Update Referral partner Type</h4>

                    <div class="modal-body text-center my-3 w-full-md-75">
                        <form wire:submit.prevent="updateReferralPartnerType">
                            <x-input type="text" name="name" wire:model.defer="referralPartnerType.name" class="text-center mb-3 "
                                     placeholder="Enter Referral Partner Type"/>
                            <x-button type="submit" class="btn btn-primary-lighter-black-hover px-5 mt-2">Update
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-12 col-lg-9 my-1 ">
                <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                    <div class="input-group-prepend border-0 align-self-center">
                        <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">

                            <div wire:target="search" wire:loading>
                                <x-spinner class="me-2"/>
                            </div>

                            <img class="w-17" src="{{asset('img/menu-icons/search-icon.svg')}}" alt=""
                                 wire:loading.remove
                                 wire:target="search"/>
                        </button>
                    </div>

                    <x-input type="text" placeholder="Search by name" aria-describedby="button-addon4"
                             class="form-control form-control-lg rounded-pill bg-none border-0 search"
                             wire:model.debounce.500ms="search"/>
                </div>
            </div>
            <div class="form-group col-12 col-lg-3 my-1 btn-group">
                <a href="{{route('dash.referral-partners.create' , $referralPartnerType->slug)}}" class="btn btn-lg btn-primary-lighter-black-hover rounded-pill  btn-header fw-400 shadow-sm mx-1 px-2 fs-14 text-capitalize">
                    + Add New Partner
                </a>
            </div>
        </div>
    </div>

    <div class="container my-3">

        @if (session()->has('delete'))
            <div class="alert alert-danger">
                {{ session('delete') }}
            </div>
        @endif

        <div class="row">
            @forelse($referralPartners as $rp)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card rounded-3 border-0">
                        <a href="{{route('dash.referral-partners.edit' , [$referralPartnerType->slug,$rp->id])}}">
                            <img class="w-100" src="{{ $rp->image_url }}" alt="">
                        </a>
                        <div class="card-body pb-4">
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">Total Leads:</div>
                                <div class="col-7 fw-500">{{ $rp->leads->count() }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">Revenue:</div>
                                <div class="col-7 fw-500">$6576675</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">Contact</div>
                                <div class="col-7 fw-500">{{ $rp->first_name }} {{ $rp->last_name }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">Contact Number:</div>
                                <div class="col-7 fw-500">{{ $rp->phone }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">Billing:</div>
                                <div class="col-7 fw-500">Monthly spend $500</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">Service areas:</div>
                                <div class="col-7 fw-500">
                                    @php
                                        $states = \App\Models\World\State::whereIn('id', $rp->service_areas['states'] ?? [])->pluck('name')->toArray();
                                        $cities = \App\Models\World\City::whereIn('id', $rp->service_areas['cities'] ?? [])->pluck('name')->toArray();
                                    @endphp
                                    <b>States:</b> {{ implode(', ', $states) }} <br/>
                                    <b>Cities:</b> {{ implode(', ', $cities) }} <br/>
                                    <b>Zipcodes:</b> {{ isset($rp->service_areas['zipcodes']) && is_array($rp->service_areas['zipcodes']) ? implode(', ', $rp->service_areas['zipcodes']) : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-center text-muted">No Referral Partner Found</h5>
            @endforelse

        </div>
    </div>

    @push('scripts')
        <script>
            CKEDITOR.replace('blog-content');
        </script>

        <script>
            window.addEventListener('show-form', event => {

                $('#ReferralPartnerTypeForm').modal('show');

            })

            window.addEventListener('hide-form', event => {

                $('#ReferralPartnerTypeForm').modal('hide');

            })


        </script>

    @endpush

</div>

