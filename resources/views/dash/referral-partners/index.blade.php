{{--@include("dash.referral-partners.{$referralPartnerType->slug}")--}}
<x-app-layout>

    <div class="container mt-3 mb-5">
        <div class="row">
            <h4 class="text-center mb-3 fw-600">Referral Partner Type</h4>
            <div class="form-group col-12 col-lg-7 my-1 ">
                <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                    <div class="input-group-prepend border-0 align-self-center">
                        <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">
                            <img class="w-17" src="/img/menu-icons/search-icon.svg" alt="">
                        </button>
                    </div>
                    <input
                        class="form-control form-control-lg form-control form-control-lg rounded-pill bg-none border-0 search"
                        type="text" placeholder="Search by name or city" aria-describedby="button-addon4">

                </div>
            </div>
            <div class="form-group col-12 col-lg-5 my-1 btn-group">

                <a href="#"
                   class="btn btn-lg btn-white-black-hover btn-hover-white-img rounded-pill btn-header fw-bold shadow-sm me-3 px-2 fs-14 d-none d-lg-block"
                   id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                   style="font-size: 13px"
                >
                    <img src="{{asset('img/menu-icons/refferal-icon.svg')}}" class="w-12 me-2" alt="">
                    Compact
                    <div wire:loading wire:target="changeDisplayAs">
                        <x-spinner class="me-2"/>
                    </div>
                    <img src="{{asset('img/menu-icons/arrow-dropdown-down.svg')}}" class="w-12 ms-2" alt="">
                </a>

                <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 py-0 text-white"
                    aria-labelledby="dropdownMenuButton1" style="">
                    <li><a class="dropdown-item li-first-child text-dark fw-500 fs-14"
                           wire:click.prevent="changeDisplayAs('grid')" href="#">
                            <img class=" me-3" width="15" src="/img/agent/icons/grid.svg" alt="">Grid</a>
                    </li>
                    <li><a class="dropdown-item text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('list')"
                           href="#">
                            <img class=" me-3" width="15" src="/img/agent/icons/list.svg" alt="">List</a>
                    </li>
                    <li><a class="dropdown-item li-last-child text-dark fw-500 fs-14"
                           wire:click.prevent="changeDisplayAs('compact')" href="#">
                            <img class=" me-3" width="15" src="/img/agent/icons/compact.svg" alt="">Compact</a>
                    </li>
                </ul>

                <a href="#"
                   class="btn btn-lg btn-primary-lighter-black-hover rounded-pill  btn-header fw-400 shadow-sm mx-1 px-2 fs-14 text-uppercase"
                   data-bs-toggle="modal" data-bs-target="#addNewReferralPartnerType"
                >
                    New Referral Partner Type
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNewReferralPartnerType" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header border-0 ms-auto pb-0">
                            <a href="javascript:void(0)"
                               class="text-decoration-none"
                               data-bs-dismiss="modal" aria-label="Close">
                                {{--                                       <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">--}}
                                <img src="{{asset('img/menu-icons/cross-icon.svg')}}"
                                     class="w-30 svg-hover-black" alt="">
                            </a>
                        </div>

                        <h4 class="modal-title text-center text-capitalize" id="staticBackdropLabel">Add new Referral
                            partner Type</h4>

                        <div class="modal-body text-center my-3 w-full-md-75">
                            <x-input type="text" class="text-center mb-3" placeholder="Enter Referral Partner Type"/>
                            <x-button class="btn btn-primary-lighter-black-hover px-5">Save</x-button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="">
                    <a href="#"
                       class="text-uppercase btn btn-lg btn-primary-light-black-hover px-5 py-3 py-md-4 w-100 rounded-3 fs-22">Lender</a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="">
                    <a href="#"
                       class="text-uppercase btn btn-lg btn-primary-light-black-hover px-5 py-3 py-md-4 w-100 rounded-3 fs-22">HOME
                        WARRANTY</a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="">
                    <a href="#"
                       class="text-uppercase btn btn-lg btn-primary-light-black-hover px-5 py-3 py-md-4 w-100 rounded-3 fs-22">CPA</a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="">
                    <a href="#"
                       class="text-uppercase btn btn-lg btn-primary-light-black-hover px-5 py-3 py-md-4 w-100 rounded-3 fs-22">HANDYMAN</a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="">
                    <a href="#"
                       class="text-uppercase btn btn-lg btn-primary-light-black-hover px-5 py-3 py-md-4 w-100 rounded-3 fs-22">HOME
                        INSURANCE</a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="">
                    <a href="#"
                       class="text-uppercase btn btn-lg btn-primary-light-black-hover px-5 py-3 py-md-4 w-100 rounded-3 fs-22">LENDER</a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            CKEDITOR.replace('blog-content');
        </script>
    @endpush

</x-app-layout>
