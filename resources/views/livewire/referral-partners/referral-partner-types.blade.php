<div>

    <div class="container mt-3 mb-5">
        <div class="row">
            <h4 class="text-center mb-3 fw-600">Referral Partner Type</h4>
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
                <a href="#"
                   class="btn btn-lg btn-primary-lighter-black-hover rounded-pill  btn-header fw-400 shadow-sm mx-1 px-2 fs-14 text-uppercase"
                   wire:click.prevent="addNewReferralType"
                >
                    New Referral Partner Type
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="ReferralPartnerTypeForm" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header border-0 ms-auto pb-0">
                            <a href="javascript:void(0)"
                               class="text-decoration-none"
                               data-bs-dismiss="modal" aria-label="Close">
                                <img src="{{asset('img/menu-icons/cross-icon.svg')}}"
                                     class="w-30 svg-hover-black" alt="">
                            </a>
                        </div>

                        <h4 class="modal-title text-center text-capitalize" id="staticBackdropLabel">Add new Referral
                            partner Type</h4>

                        <div class="modal-body text-center my-3 w-full-md-75">
                            <form wire:submit.prevent="createReferralPartnerType">
                                <x-input type="text" name="name" wire:model.defer="name" class="text-center mb-3 "
                                         placeholder="Enter Referral Partner Type"/>
                                <x-button type="submit" class="btn btn-primary-lighter-black-hover px-5 mt-2">Save
                                </x-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End  Modal -->
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            @forelse($referralPartnerTypes as $rpt)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="">
                        <a href="{{ route('dash.referral-partners.referral-partners-by-type', [$rpt->slug]) }}"
                           class="text-uppercase btn btn-lg btn-primary-light-black-hover px-5 py-3 py-md-4 w-100 rounded-3 fs-22">{{$rpt->name}}</a>
                    </div>
                </div>
            @empty
                <h5 class="text-center text-muted">No Referral Partner Type Found</h5>
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
