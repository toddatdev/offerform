<x-app-layout>
    <x-slot name="header">
        <div class="container header-container my-3">
            <div class="row">
                <div class="form-group col-12 col-md-5 col-lg-6 my-1 ">
                    <x-input type="text" placeholder="Search User by name"
                             class="rounded-pill border-0 px-3 shadow-sm"/>
                </div>
                <div class="form-group col-12 col-md-7 col-lg-6 my-1 btn-group">
                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 fs-14">
                        +Add New Home Insurance
                    </a>
                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 fs-14">
                        Grid
                    </a>
                    <a href="#"
                       class="btn btn-lg rounded-pill bg-primary-lighter text-white btn-header fw-bold shadow-sm mx-1 fs-14">
                        + Add New Offer Form
                    </a>

                </div>
            </div>
        </div>
        <div class="container header-container my-3">
            <div class="row">
                <div class="form-group col-12 col-md-5 col-lg-6 my-1 ">
                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 px-3 fs-14">
                        < Back to my offers
                    </a>
                </div>

                <div class="form-group col-12 col-md-7 col-lg-6 my-1 text-end">
                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 px-x fs-14"
                       type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class=" mx-2" width="15" src="{{asset('img/agent/icons/export.svg')}}" alt=""> Export To...
                    </a>

                    <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white "
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Download PDF</a></li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Email</a></li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Zapier</a></li>
                    </ul>

                </div>
            </div>
            <hr>
        </div>

        <div class="container header-container my-3">
            <div class="row">
                <div class="form-group col-12 col-md-5 col-lg-6 my-1 ">
                    <x-input type="text" placeholder="Search User by name"
                             class="rounded-pill border-0 px-3 shadow-sm"/>
                </div>
                <div class="form-group col-12 col-md-7 col-lg-6 my-1 btn-group">
                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 px-2 fs-14">
                        <img class=" mx-2" width="15" src="{{asset('img/agent/icons/trash.svg')}}" alt=""> Archive
                    </a>
                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 px-2 fs-14"
                       type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                    >
                        <span class="text-muted mx-1">Sort:</span> Data Submitted
                    </a>

                    <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white "
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Action</a></li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Another action</a></li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Something else here</a></li>
                    </ul>


                    <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 px-2 fs-14"
                       type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                    >
                        <img class=" mx-2" width="15" src="{{asset('img/agent/icons/grid.svg')}}" alt="">Grid
                    </a>

                    <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white "
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Grid</a></li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">List</a></li>
                        <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Compact</a></li>
                    </ul>


                    <a href="#"
                       class="btn btn-lg rounded-pill bg-primary-lighter text-white btn-header fw-bold shadow-sm mx-1 px-2 fs-14">
                        <img class=" mx-2" width="15" src="{{asset('img/agent/icons/category.svg')}}" alt=""> Form
                        Categories
                    </a>

                </div>
            </div>
        </div>

    </x-slot>


    <div class="container my-5">

        <div class="row mb-4">
            <div class="col-12 col-lg-6">
                <h5 class="fw-bold">
                    <img class="rounded-circle rounded-icon shadow-sm me-2" src="{{asset('img/agent/icons/map.svg')}}"
                         alt="">
                    123 Main Street Bend, Oregon 97701, USA
                </h5>
                <div class="thumbnail my-2">
                    <img class="img-fluid" src="{{asset('img/agent/completed-offerforms/cof2.png')}}" alt="">
                </div>

            </div>
            <div class="col-12 col-lg-6">
                <h5 class="fw-bold">
                    <img class="rounded-circle rounded-icon shadow-sm me-2" src="{{asset('img/agent/icons/map.svg')}}"
                         alt="">
                    123 Main Street Bend, Oregon 97701, USA
                </h5>
                <div class="card border-0 py-4 shadow">
                    <div class="card-body d-flex justify-content-between">
                        <div class="align-self-center">
                            <img class="rounded-circle w-75"
                                 src="{{asset('img/agent/completed-offerforms/user-img.png')}}" alt="">
                        </div>
                        <div class="text-end">
                            <h3 class="text-primary-light fw-bold">Cody Tuma</h3>
                            <p class="fw-bold fs-18">541-953-7784</p>
                            <p>cody@541homesales.com</p>
                            <p>541 Home Sales</p>
                            <p>www.541homesales.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-relative mb-5 mb-lg-0 ">
            <div class="form-group fw-bold position-absolute checkall-card mb-5 mb-lg-0" style="left: -103px">
                <label for="">Check All</label> <input type="checkbox" class="buyer-info-checkbox">
            </div>
        </div>


        <div class="card position-relative buyer-info-card border-0 bg-transparent mb-4">
            <p class="fw-bold">
                <img class="rounded-circle rounded-icon shadow-sm me-2" src="{{asset('img/agent/icons/buyer.svg')}}"
                     alt="">Buyer Contact Information
            </p>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="card position-relative buyer-info-card border-0 bg-transparent mb-4">
            <p class="fw-bold">
                <img class="rounded-circle rounded-icon shadow-sm me-2" src="{{asset('img/agent/icons/buyer.svg')}}"
                     alt="">Buyer Contact Information
            </p>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="card position-relative buyer-info-card border-0 bg-transparent mb-4">
            <p class="fw-bold">
                <img class="rounded-circle rounded-icon shadow-sm me-2" src="{{asset('img/agent/icons/buyer.svg')}}"
                     alt="">Buyer Contact Information
            </p>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
            <div class="card-body position-relative  bg-primary-light mb-3 p-3 rounded-2">
                <div class="form-group fw-bold position-absolute buyer-content-information ">
                    <input type="checkbox" class="buyer-info-checkbox">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=" mb-0 text-white">
                            <img class="small-icon shadow-sm me-2"
                                 src="{{asset('img/agent/icons/glyph-price.svg')}}"
                                 alt="">
                            Buyer First Name
                        </p>
                    </div>
                    <div>
                        <p class="text-white mb-0">John</p>
                    </div>

                </div>
            </div>
        </div>


    </div>


    <div class="container my-5">
        <div class="bg-white card border-0 mb-4">
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
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-center">
                    <div class="inner-border border-warning mx-auto rounded-circle">
                        <p class="mb-0 fw-bold fs-14 pt-3">
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
        <div class="bg-white card border-0 mb-4">
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
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-center">
                    <div class="inner-border border-warning mx-auto rounded-circle">
                        <p class="mb-0 fw-bold fs-14 pt-3">
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
        <div class="bg-white card border-0 mb-4">
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
                <div class="col-12 col-lg-4 my-3 my-lg-0 align-self-center text-center">
                    <div class="inner-border border-warning mx-auto rounded-circle">
                        <p class="mb-0 fw-bold fs-14 pt-3">
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


    <div class="container my-5 agent-completed-form-card">
        <div class="row">
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
                                <div class="inner-border border-warning rounded-circle">
                                    <p class="mb-0 fw-bold fs-14 pt-3">
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
                                <div class="inner-border border-warning rounded-circle">
                                    <p class="mb-0 fw-bold fs-14 pt-3">
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
                                <div class="inner-border border-warning rounded-circle">
                                    <p class="mb-0 fw-bold fs-14 pt-3">
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


    <div class="container my-4 pb-5 ">

        <h3 class="text-center fw-bold mb-5">
            <img class="img-fluid mx-3" width="20" src="{{asset('img/agent/icons/category-primary.svg')}}" alt="">
            Form Categories
        </h3>

        <div class="bg-primary-light py-3 category-card mb-4 rounded-2 px-3">
            <div class="row">
                <div class="col-8 col-md-6">
                    <div class="col-inner d-flex">
                        <div class="bg-white align-self-center agent-category-icon p-2 py-0 rounded-circle">
                            <i class="fa fa-key"></i>
                            {{--<img class="img-fluid p-3" width="33" src="{{asset('img/agent/categories/cat1.svg')}}" alt="">--}}
                        </div>
                        <div class="mx-2 align-self-center">
                            <p class="text-white mb-0">Key Offer Terms</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-6 text-end text-lg-start">
                    <div>
                        <img class="img-fluid" style="width: 30px" src="{{asset('img/agent/categories/cat-grid.svg')}}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary-light py-3 category-card mb-4 rounded-2 px-3">
            <div class="row">
                <div class="col-8 col-md-6">
                    <div class="col-inner d-flex">
                        <div class="bg-white align-self-center agent-category-icon p-2 py-0 rounded-circle">
                            <i class="fa fa-calendar"></i>
                            {{--<img class="img-fluid p-3" width="33" src="{{asset('img/agent/categories/cat1.svg')}}" alt="">--}}
                        </div>
                        <div class="mx-2 align-self-center">
                            <p class="text-white mb-0">Key Offer Terms</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-6 text-end text-lg-start">
                    <div>
                        <img class="img-fluid" style="width: 30px" src="{{asset('img/agent/categories/cat-grid.svg')}}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary-light py-3 category-card mb-4 rounded-2 px-3">
            <div class="row">
                <div class="col-8 col-md-6">
                    <div class="col-inner d-flex">
                        <div class="bg-white align-self-center agent-category-icon p-2 py-0 rounded-circle">
                            <i class="fa fa-calendar"></i>
                            {{--<img class="img-fluid p-3" width="33" src="{{asset('img/agent/categories/cat1.svg')}}" alt="">--}}
                        </div>
                        <div class="mx-2 align-self-center">
                            <p class="text-white mb-0">Key Offer Terms</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-6 text-end text-lg-start">
                    <div>
                        <img class="img-fluid" style="width: 30px" src="{{asset('img/agent/categories/cat-grid.svg')}}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary-light py-3 category-card mb-4 rounded-2 px-3">
            <div class="row">
                <div class="col-8 col-md-6">
                    <div class="col-inner d-flex">
                        <div class="bg-white align-self-center agent-category-icon p-2 py-0 rounded-circle">
                            <i class="fa fa-home"></i>
                            {{--<img class="img-fluid p-3" width="33" src="{{asset('img/agent/categories/cat1.svg')}}" alt="">--}}
                        </div>
                        <div class="mx-2 align-self-center">
                            <p class="text-white mb-0">Key Offer Terms</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-6 text-end text-lg-start">
                    <div>
                        <img class="img-fluid" style="width: 30px" src="{{asset('img/agent/categories/cat-grid.svg')}}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary-light py-3 category-card mb-4 rounded-2 px-3">
            <div class="row">
                <div class="col-8 col-md-6">
                    <div class="col-inner d-flex">
                        <div class="bg-white align-self-center agent-category-icon p-2 py-0 rounded-circle">
                            <i class="fa fa-key"></i>
                            {{--<img class="img-fluid p-3" width="33" src="{{asset('img/agent/categories/cat1.svg')}}" alt="">--}}
                        </div>
                        <div class="mx-2 align-self-center">
                            <p class="text-white mb-0">Key Offer Terms</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-6 text-end text-lg-start">
                    <div>
                        <img class="img-fluid" style="width: 30px" src="{{asset('img/agent/categories/cat-grid.svg')}}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary-light py-3 category-card mb-4 rounded-2 px-3">
            <div class="row">
                <div class="col-8 col-md-6">
                    <div class="col-inner d-flex">
                        <div class="bg-white align-self-center agent-category-icon p-2 py-0 rounded-circle">
                            <i class="fa fa-clock-o"></i>
                            {{--<img class="img-fluid p-3" width="33" src="{{asset('img/agent/categories/cat1.svg')}}" alt="">--}}
                        </div>
                        <div class="mx-2 align-self-center">
                            <p class="text-white mb-0">Key Offer Terms</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-6 text-end text-lg-start">
                    <div>
                        <img class="img-fluid" style="width: 30px" src="{{asset('img/agent/categories/cat-grid.svg')}}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container my-4 agent-card-container">
        <div class="card border-0 py-3 rounded-3 mb-4">
            <div class="card-body text-center">
                <h4 class="text-primary-light fw-bold">Standard Buyer OfferForm</h4>
                <h5 class="text-dark fw-bold my-4">This is the Standard Universal Form Created By OfferForm</h5>

                <div class="d-flex flex-column justify-content-center  flex-lg-row mb-3 ">
                    <div class="mx-3">
                        <p class="text-primary-light fs-17">Created by: <span class="text-dark mx-1">Nouman Afzal</span></p>
                    </div>

                    <div class="mx-3">
                        <p class="text-primary-light fs-17">Last modified: <span
                                class="text-dark mx-1">Feb 22, 2022, 4:42 AM</span></p>
                    </div>
                </div>

                <div class="btn-group" role="group" aria-label="Basic example">

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 dropdown btn btn-lg btn-primary-light  dropdown-toggle"
                       type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-paper-plane px-2"></i>Send Form</a>

                    <ul class="dropdown-menu bg-primary-light border-0 rounded-3 mt-2 text-white "
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-white" href="#">Action</a></li>
                        <li><a class="dropdown-item text-white" href="#">Another action</a></li>
                        <li><a class="dropdown-item text-white" href="#">Something else here</a></li>
                    </ul>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-edit px-2"></i>Edit</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-clone px-2"></i>Duplicate</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-trash px-2"></i>Delete</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-lighter text-white "><i
                            class="fa fa-eye px-2"></i>View Form</a>

                </div>

            </div>
        </div>
        <div class="card border-0 py-3 rounded-3 mb-4">
            <div class="card-body text-center">
                <h4 class="text-primary-light fw-bold">Standard Buyer OfferForm</h4>
                <h5 class="text-dark fw-bold my-4">This is the Standard Universal Form Created By OfferForm</h5>

                <div class="d-flex flex-column justify-content-center  flex-lg-row mb-3 ">
                    <div class="mx-3">
                        <p class="text-primary-light fs-17">Created by: <span class="text-dark mx-1">Nouman Afzal</span></p>
                    </div>

                    <div class="mx-3">
                        <p class="text-primary-light fs-17">Last modified: <span
                                class="text-dark mx-1">Feb 22, 2022, 4:42 AM</span></p>
                    </div>
                </div>

                <div class="btn-group" role="group" aria-label="Basic example">

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 dropdown btn btn-lg btn-primary-light  dropdown-toggle"
                       type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-paper-plane px-2"></i>Send Form</a>

                    <ul class="dropdown-menu bg-primary-light border-0 rounded-3 mt-2 text-white "
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-white" href="#">Action</a></li>
                        <li><a class="dropdown-item text-white" href="#">Another action</a></li>
                        <li><a class="dropdown-item text-white" href="#">Something else here</a></li>
                    </ul>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-edit px-2"></i>Edit</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-clone px-2"></i>Duplicate</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-trash px-2"></i>Delete</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-lighter text-white "><i
                            class="fa fa-eye px-2"></i>View Form</a>

                </div>

            </div>
        </div>
        <div class="card border-0 py-3 rounded-3 mb-4">
            <div class="card-body text-center">
                <h4 class="text-primary-light fw-bold">Standard Buyer OfferForm</h4>
                <h5 class="text-dark fw-bold my-4">This is the Standard Universal Form Created By OfferForm</h5>

                <div class="d-flex flex-column justify-content-center  flex-lg-row mb-3 ">
                    <div class="mx-3">
                        <p class="text-primary-light fs-17">Created by: <span class="text-dark mx-1">Nouman Afzal</span></p>
                    </div>

                    <div class="mx-3">
                        <p class="text-primary-light fs-17">Last modified: <span
                                class="text-dark mx-1">Feb 22, 2022, 4:42 AM</span></p>
                    </div>
                </div>

                <div class="btn-group" role="group" aria-label="Basic example">

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 dropdown btn btn-lg btn-primary-light  dropdown-toggle"
                       type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-paper-plane px-2"></i>Send Form</a>

                    <ul class="dropdown-menu bg-primary-light border-0 rounded-3 mt-2 text-white "
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-white" href="#">Action</a></li>
                        <li><a class="dropdown-item text-white" href="#">Another action</a></li>
                        <li><a class="dropdown-item text-white" href="#">Something else here</a></li>
                    </ul>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-edit px-2"></i>Edit</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-clone px-2"></i>Duplicate</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-light "><i
                            class="fa fa-trash px-2"></i>Delete</a>

                    <a href="#"
                       class="rounded-pill px-3 py-2 fs-14  border mx-1 my-2 my-lg-0 fs-16 btn btn-lg btn-primary-lighter text-white "><i
                            class="fa fa-eye px-2"></i>View Form</a>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
