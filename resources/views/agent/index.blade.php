<x-app-layout>
    <x-slot name="header">
        <div class="container header-container my-3">
            <div class="row">
                <div class="form-group col-12 col-md-6 col-lg-8 my-1 ">
                    <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                        <div class="input-group-prepend border-0 align-self-center">
                            <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">
                                <img class="w-17" src="{{asset('img/menu-icons/search-icon.svg')}}" alt="">
                            </button>
                        </div>
                        <x-input type="text" placeholder="Search Forms by Offerfrom Name" aria-describedby="button-addon4"
                                 class="form-control form-control-lg rounded-pill bg-none border-0 search" wire:model="search"/>
                    </div>
                </div>
                <div class="form-group col-12 col-md-6 col-lg-4 my-1 btn-group">
                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 px-2 fs-14"
                       type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                    >
                        <span class="text-muted mx-1">Sort:</span> Data Submitted
                    </a>

                    <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white "
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Data Submitted</a></li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">A-Z</a></li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">NEW</a></li>
                    </ul>


                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 px-2 fs-14"
                       type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                    >
                        <img class=" mx-2" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt="">Grid
                    </a>

                    <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white "
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">
                                <img class=" me-3" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt="">Grid</a>
                        </li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">
                                <img class=" me-3" width="15" src="{{asset('img/agent/icons/list.svg')}}" alt="">List</a>
                        </li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">
                                <img class=" me-3" width="15" src="{{asset('img/agent/icons/compact.svg')}}" alt="">Compact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </x-slot>


{{--    Grid View--}}

    <div class="container my-4 agent-completed-form-card">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img class="img-fluid" src="{{asset('img/agent/completed-offerforms/cof1.png')}}" alt="">
                    <div class="card-body p-3">
                        <h5 class="text-primary-light">123 Main Street Bend, OR</h5>

                        <div class="d-flex flex-column flex-lg-row my-3">
                            <div class="">
                                <p class="bg-light rounded-pill px-2 py-1 text-uppercase fw-bold"><i
                                        class="fa fa-bell text-danger px-2"></i>NEW</p>
                            </div>
                            <div class=" mx-3">
                                <p class="py-1">Submitted: <b class="mx-3">08.24.21 @ 11:05 AM</b></p>
                            </div>
                        </div>

                        <div class="px-0">
                            <ul class="list-group list-group-horizontal px-0 d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Buyer:</li>
                                <li class="list-group-item border-0 px-0 text-primary-light fw-bold ps-5">John Chao, Ada Chao</li>
                            </ul>
                            <ul class="list-group list-group-horizontal d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Offer Amount:</li>
                                <li class="list-group-item border-0 px-0 fw-bold ps-5">$500,000</li>
                            </ul>
                            <ul class="list-group list-group-horizontal d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Earnest Money:</li>
                                <li class="list-group-item border-0 px-0 fw-bold ps-5">$5,000</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between mt-5 mt-lg-2 ">
                            <div class="align-self-end">
                                <input type="checkbox"> <label for="" class="fs-12 fw-bold">Offer Accepted</label>
                            </div>
                            <div class="align-self-end">
                                <a href="#" class="fs-12 fw-bold text-decoration-none text-dark ">
                                    <img class="mx-2" width="15" src="{{asset('img/agent/icons/trash.svg')}}" alt="">
                                    Archive</a>
                            </div>
                            <div class="outer-border rounded-circle align-self-end">
                                <div class="inner-border border-warning rounded-circle d-flex align-items-center justify-content-center">
                                    <p class="mb-0 fw-bold fs-14">
                                        Closing </br>08.03.2021
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img class="img-fluid" src="{{asset('img/agent/completed-offerforms/cof1.png')}}" alt="">
                    <div class="card-body p-3">
                        <h5 class="text-primary-light">123 Main Street Bend, OR</h5>

                        <div class="d-flex flex-column flex-lg-row my-3">
                            <div class="">
                                <p class=" bg-light rounded-pill px-2 py-1 text-uppercase fw-bold"><i
                                        class="fa fa-bell text-danger px-2"></i>NEW</p>
                            </div>
                            <div class=" mx-3">
                                <p class="py-1">Submitted: <b class="mx-3">08.24.21 @ 11:05 AM</b></p>
                            </div>
                        </div>

                        <div class="px-0">
                            <ul class="list-group list-group-horizontal px-0 d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Buyer:</li>
                                <li class="list-group-item border-0 px-0 text-primary-light fw-bold ps-5">John Chao, Ada
                                    Chao
                                </li>
                            </ul>
                            <ul class="list-group list-group-horizontal d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Offer Amount:</li>
                                <li class="list-group-item border-0 px-0 fw-bold ps-5">$500,000</li>
                            </ul>
                            <ul class="list-group list-group-horizontal d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Earnest Money:</li>
                                <li class="list-group-item border-0 px-0 fw-bold ps-5">$5,000</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between mt-5 mt-lg-2 ">
                            <div class="align-self-end">
                                <input type="checkbox"> <label for="" class="fs-12 fw-bold">Offer Accepted</label>
                            </div>
                            <div class="align-self-end">
                                <a href="#" class="fs-12 fw-bold text-decoration-none text-dark ">
                                    <img class="mx-2" width="15" src="{{asset('img/agent/icons/trash.svg')}}" alt="">
                                    Archive</a>
                            </div>
                            <div class="outer-border rounded-circle align-self-end">
                                <div class="inner-border border-warning rounded-circle d-flex align-items-center justify-content-center">
                                    <p class="mb-0 fw-bold fs-14">
                                        Closing </br>08.03.2021
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card rounded-3 border-0">
                    <img class="img-fluid" src="{{asset('img/agent/completed-offerforms/cof1.png')}}" alt="">
                    <div class="card-body p-3">
                        <h5 class="text-primary-light">123 Main Street Bend, OR</h5>

                        <div class="d-flex flex-column flex-lg-row my-3">
                            <div class="">
                                <p class=" bg-light rounded-pill px-2 py-1 text-uppercase fw-bold"><i
                                        class="fa fa-bell text-danger px-2"></i>NEW</p>
                            </div>
                            <div class=" mx-3">
                                <p class="py-1">Submitted: <b class="mx-3">08.24.21 @ 11:05 AM</b></p>
                            </div>
                        </div>

                        <div class="px-0">
                            <ul class="list-group list-group-horizontal px-0 d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Buyer:</li>
                                <li class="list-group-item border-0 px-0 text-primary-light fw-bold ps-5">John Chao, Ada
                                    Chao
                                </li>
                            </ul>
                            <ul class="list-group list-group-horizontal d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Offer Amount:</li>
                                <li class="list-group-item border-0 px-0 fw-bold ps-5">$500,000</li>
                            </ul>
                            <ul class="list-group list-group-horizontal d-flex justify-content-start">
                                <li class="list-group-item border-0 px-0">Earnest Money:</li>
                                <li class="list-group-item border-0 px-0 fw-bold ps-5">$5,000</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between mt-5 mt-lg-2 ">
                            <div class="align-self-end">
                                <input type="checkbox"> <label for="" class="fs-12 fw-bold">Offer Accepted</label>
                            </div>
                            <div class="align-self-end">
                                <a href="#" class="fs-12 fw-bold text-decoration-none text-dark ">
                                    <img class="mx-2" width="15" src="{{asset('img/agent/icons/trash.svg')}}" alt="">
                                    Archive</a>
                            </div>
                            <div class="outer-border rounded-circle align-self-end">
                                <div class="inner-border border-warning rounded-circle d-flex align-items-center justify-content-center">
                                    <p class="mb-0 fw-bold fs-14">
                                        Closing </br>08.03.2021
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    List View--}}

    <div class="container my-5">
        <div class="card border-0 mb-4">
            <div class="row card-body">
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center">
                    <h6 class="fw-bold">123 Main Street Bend, OR
                        <span class=" bg-light rounded-pill px-2 py-1 mx-2 text-uppercase fw-bold"><i
                                class="fa fa-bell text-danger px-2"></i>NEW</span>
                    </h6>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fs-12 mb-0">Buyer</p>
                            <p class="fs-12 mb-0 fw-bold">John Chao,Ada Chao</p>
                        </div>
                        <div>
                            <p class="fs-12 mb-0">Offer Amount</p>
                            <p class="fs-12 mb-0 fw-bold">$500,000</p>
                        </div>
                        <div>
                            <p class="fs-12 mb-0">Earnest Money</p>
                            <p class="fs-12 mb-0 fw-bold">$5,000</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-center ">
                    <div class="inner-border border-warning mx-auto rounded-circle d-flex align-items-center justify-content-center">
                        <p class="mb-0 fw-bold fs-14">
                            Closing </br>08.03.2021
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-start text-lg-end">
                    <p class="">Submitted: <b class="mx-2">08.24.21 @ 11:05 AM</b></p>
                    <p class=""><input type="checkbox"> <b class="mx-2">Offer Accepted</b></p>
                    <p class=""><img src="{{asset('img/agent/icons/trash.svg')}}" alt=""> <b class="mx-2">Archive</b>
                    </p>
                </div>
            </div>
        </div>
        <div class="card border-0 mb-4">
            <div class="row card-body">
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center">
                    <h6 class="fw-bold">123 Main Street Bend, OR
                        <span class=" bg-light rounded-pill px-2 py-1 mx-2 text-uppercase fw-bold"><i
                                class="fa fa-bell text-danger px-2"></i>NEW</span>
                    </h6>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fs-12 mb-0">Buyer</p>
                            <p class="fs-12 mb-0 fw-bold">John Chao,Ada Chao</p>
                        </div>
                        <div>
                            <p class="fs-12 mb-0">Offer Amount</p>
                            <p class="fs-12 mb-0 fw-bold">$500,000</p>
                        </div>
                        <div>
                            <p class="fs-12 mb-0">Earnest Money</p>
                            <p class="fs-12 mb-0 fw-bold">$5,000</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-center ">
                    <div class="inner-border border-warning mx-auto rounded-circle d-flex align-items-center justify-content-center">
                        <p class="mb-0 fw-bold fs-14">
                            Closing </br>08.03.2021
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-start text-lg-end">
                    <p class="">Submitted: <b class="mx-2">08.24.21 @ 11:05 AM</b></p>
                    <p class=""><input type="checkbox"> <b class="mx-2">Offer Accepted</b></p>
                    <p class=""><img src="{{asset('img/agent/icons/trash.svg')}}" alt=""> <b class="mx-2">Archive</b>
                    </p>
                </div>
            </div>
        </div>
        <div class="card border-0 mb-4">
            <div class="row card-body">
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center">
                    <h6 class="fw-bold">123 Main Street Bend, OR
                        <span class=" bg-light rounded-pill px-2 py-1 mx-2 text-uppercase fw-bold"><i
                                class="fa fa-bell text-danger px-2"></i>NEW</span>
                    </h6>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fs-12 mb-0">Buyer</p>
                            <p class="fs-12 mb-0 fw-bold">John Chao,Ada Chao</p>
                        </div>
                        <div>
                            <p class="fs-12 mb-0">Offer Amount</p>
                            <p class="fs-12 mb-0 fw-bold">$500,000</p>
                        </div>
                        <div>
                            <p class="fs-12 mb-0">Earnest Money</p>
                            <p class="fs-12 mb-0 fw-bold">$5,000</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-center ">
                    <div class="inner-border border-warning mx-auto rounded-circle d-flex align-items-center justify-content-center">
                        <p class="mb-0 fw-bold fs-14">
                            Closing </br>08.03.2021
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-start text-lg-end">
                    <p class="">Submitted: <b class="mx-2">08.24.21 @ 11:05 AM</b></p>
                    <p class=""><input type="checkbox"> <b class="mx-2">Offer Accepted</b></p>
                    <p class=""><img src="{{asset('img/agent/icons/trash.svg')}}" alt=""> <b class="mx-2">Archive</b>
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
