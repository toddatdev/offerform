
<x-app-layout>

    <div class="container mt-3 mb-5 ">

            <h2 class="text-center mb-5">Partner Name Type</h2>

            <a href="#" class="btn btn-lg btn-primary-lighter-black-hover rounded-pill btn-header fw-400 shadow-sm mx-1 px-4 fs-14 mb-3 text-uppercase btn-sm-100">
                CHANGE REFERRAL TYPE NAME
            </a>
            <div class="row">
                <div class="form-group col-12 col-lg-8 my-1 ">
                    <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                        <div class="input-group-prepend border-0 align-self-center">
                            <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">
                                <img class="w-17" src="/img/menu-icons/search-icon.svg" alt="">
                            </button>
                        </div>
                        <input class="form-control form-control-lg form-control form-control-lg rounded-pill bg-none border-0 search"
                               type="text" placeholder="Search by name or city" aria-describedby="button-addon4" wire:model="search">

                    </div>
                </div>
                <div class="form-group col-12 col-lg-4 my-1 btn-group">
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

                    <ul class="dropdown-menu bg-white border-0 rounded-3 py-0 mt-2 text-white" aria-labelledby="dropdownMenuButton1" style="">
                        <li><a class="dropdown-item li-first-child text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('grid')" href="#">
                                <img class=" me-3" width="15" src="/img/agent/icons/grid.svg" alt="">Grid</a>
                        </li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('list')" href="#">
                                <img class=" me-3" width="15" src="/img/agent/icons/list.svg" alt="">List</a>
                        </li>
                        <li><a class="dropdown-item li-last-child text-dark fw-500 fs-14" wire:click.prevent="changeDisplayAs('compact')" href="#">
                                <img class=" me-3" width="15" src="/img/agent/icons/compact.svg" alt="">Compact</a>
                        </li>
                    </ul>
                    <a href="{{route('dash.referral-partners.lender-advance-screen')}}" class="btn btn-lg btn-primary-lighter-black-hover rounded-pill  btn-header fw-400 shadow-sm mx-1 px-2 fs-14 text-capitalize">
                        + Add New Partner
                    </a>
                </div>
            </div>
        </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body pb-4">
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Total Leads:</div>
                            <div class="col-7 fw-500">290</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Revenue:</div>
                            <div class="col-7 fw-500">$6576675</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact</div>
                            <div class="col-7 fw-500">Jason west </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact Number:</div>
                            <div class="col-7 fw-500">(541) 987-4532</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Billing:</div>
                            <div class="col-7 fw-500">Monthly spend $500</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Service areas :</div>
                            <div class="col-7 fw-500">Oregon, California,idaho</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body pb-4">
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Total Leads:</div>
                            <div class="col-7 fw-500">290</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Revenue:</div>
                            <div class="col-7 fw-500">$6576675</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact</div>
                            <div class="col-7 fw-500">Jason west </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact Number:</div>
                            <div class="col-7 fw-500">(541) 987-4532</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Billing:</div>
                            <div class="col-7 fw-500">Monthly spend $500</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Service areas :</div>
                            <div class="col-7 fw-500">Oregon, California,idaho</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body pb-4">
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Total Leads:</div>
                            <div class="col-7 fw-500">290</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Revenue:</div>
                            <div class="col-7 fw-500">$6576675</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact</div>
                            <div class="col-7 fw-500">Jason west </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact Number:</div>
                            <div class="col-7 fw-500">(541) 987-4532</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Billing:</div>
                            <div class="col-7 fw-500">Monthly spend $500</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Service areas :</div>
                            <div class="col-7 fw-500">Oregon, California,idaho</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body pb-4">
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Total Leads:</div>
                            <div class="col-7 fw-500">290</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Revenue:</div>
                            <div class="col-7 fw-500">$6576675</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact</div>
                            <div class="col-7 fw-500">Jason west </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact Number:</div>
                            <div class="col-7 fw-500">(541) 987-4532</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Billing:</div>
                            <div class="col-7 fw-500">Monthly spend $500</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Service areas :</div>
                            <div class="col-7 fw-500">Oregon, California,idaho</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body pb-4">
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Total Leads:</div>
                            <div class="col-7 fw-500">290</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Revenue:</div>
                            <div class="col-7 fw-500">$6576675</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact</div>
                            <div class="col-7 fw-500">Jason west </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact Number:</div>
                            <div class="col-7 fw-500">(541) 987-4532</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Billing:</div>
                            <div class="col-7 fw-500">Monthly spend $500</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Service areas :</div>
                            <div class="col-7 fw-500">Oregon, California,idaho</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body pb-4">
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Total Leads:</div>
                            <div class="col-7 fw-500">290</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Revenue:</div>
                            <div class="col-7 fw-500">$6576675</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact</div>
                            <div class="col-7 fw-500">Jason west </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Contact Number:</div>
                            <div class="col-7 fw-500">(541) 987-4532</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Billing:</div>
                            <div class="col-7 fw-500">Monthly spend $500</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">Service areas :</div>
                            <div class="col-7 fw-500">Oregon, California,idaho</div>
                        </div>
                    </div>
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

