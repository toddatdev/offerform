<x-app-layout>
    <x-slot name="header">
        {{--        <div class="container header-container my-3">--}}
        {{--            <div class="d-flex flex-column flex-lg-row justify-content-between">--}}

        {{--                <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm px-3 fs-14">--}}
        {{--                    <i class="fa fa-angle-left"></i> Back to my offers--}}
        {{--                </a>--}}

        {{--                <a href="#" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm  px-x fs-14"--}}
        {{--                   type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
        {{--                    <img class=" mx-2" width="15" src="{{asset('img/agent/icons/export.svg')}}" alt=""> Export To...--}}
        {{--                </a>--}}

        {{--                <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 text-white "--}}
        {{--                    aria-labelledby="dropdownMenuButton1">--}}
        {{--                    <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Download PDF</a></li>--}}
        {{--                    <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Email</a></li>--}}
        {{--                    <li><a class="dropdown-item text-dark fw-500 fs-14" href="#">Zapier</a></li>--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--            <hr>--}}
        {{--        </div>--}}

    </x-slot>


    {{--    Sign up for Offer Form as a team or brokerage--}}

    <div class="container my-5">
        <div class="card border-0 rounded-30">
            <div class="card-body row py-5 px-4">
                <div class="form-group col-12 col-lg-6 mb-3">
                    <x-input class="text-center" placeholder="Brokerage / Team name"/>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                    <x-input class="text-center" placeholder="Company Admin Name"/>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                    <x-input class="text-center" placeholder="Admin Email"/>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                    <x-input class="text-center" placeholder="Admin Phone Number"/>
                </div>

                <div class="form-group col-12 col-lg-6 mb-3">
                    <div class="input-group">
                        <x-input type="text" class="text-center" placeholder="Number of Agents"/>
                        <button class="btn btn-outline-warning dropdown-toggle px-4 outline-none" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="border-color: #8d8d8d78"></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">1</a></li>
                            <li><a class="dropdown-item" href="#">2</a></li>
                            <li><a class="dropdown-item" href="#">3</a></li>
                            <li><a class="dropdown-item" href="#">4</a></li>
                            <li><a class="dropdown-item" href="#">5</a></li>
                            <li><a class="dropdown-item" href="#">6</a></li>
                        </ul>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                    <x-input class="text-center" placeholder="Password"/>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                    <x-input class="text-center" placeholder="Your position with company"/>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                    <x-input class="text-center" placeholder="Re enter Password"/>
                </div>

                <div class="mt-5 mb-3 d-flex flex-column flex-lg-row justify-content-evenly">
                    <div class="form-check ">
                        <input class="form-check-input" class="" type="checkbox" value="" id="flexCheckDefault"/>
                        <label class="form-check-label" for="flexCheckDefault">
                            I agree to <span class="text-primary-light">Terms and Service</span>
                        </label>
                    </div>
                    <div class="">
                        <x-button class="btn btn-lg btn-primary-light px-3 text-uppercase fs-14">Create free team account
                        </x-button>
                    </div>
                </div>

                <div class="text-center">
                    <p>Already a member?<a href="#" class="text-decoration-none text-primary-light">Login</a></p>
                    <p>Sign up as an individual agent <a href="#" class=" text-primary-light">here</a></p>
                </div>
            </div>
        </div>
    </div>


    {{--    Team container--}}

    <div class="container my-5">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card rounded-3 border-0 shadow-sm">
                    <img class="img-fluid" src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body">
                        <p>Total Users: 500</p>
                        <p>Free plan</p>
                        <p>Team code : PPG1</p>
                        <p>Contact: <b class="ms-3">Jason west (541) 987-4532</b></p>
                        <p class="fw-bold">Title rep associated : Susan johnson</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card rounded-3 border-0 shadow-sm">
                    <img class="img-fluid" src="{{asset('img/dash/team/t2.png')}}" alt="">
                    <div class="card-body">
                        <p>Total Users: 500</p>
                        <p>Free plan</p>
                        <p>Team code : PPG1</p>
                        <p>Contact: <b class="ms-3">Jason west (541) 987-4532</b></p>
                        <p class="fw-bold">Title rep associated : Susan johnson</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card rounded-3 border-0 shadow-sm">
                    <img class="img-fluid" src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body">
                        <p>Total Users: 500</p>
                        <p>Free plan</p>
                        <p>Team code : PPG1</p>
                        <p>Contact: <b class="ms-3">Jason west (541) 987-4532</b></p>
                        <p class="fw-bold">Title rep associated : Susan johnson</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card rounded-3 border-0 shadow-sm">
                    <img class="img-fluid" src="{{asset('img/dash/team/t2.png')}}" alt="">
                    <div class="card-body">
                        <p>Total Users: 500</p>
                        <p>Free plan</p>
                        <p>Team code : PPG1</p>
                        <p>Contact: <b class="ms-3">Jason west (541) 987-4532</b></p>
                        <p class="fw-bold">Title rep associated : Susan johnson</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card rounded-3 border-0 shadow-sm">
                    <img class="img-fluid" src="{{asset('img/dash/team/t1.png')}}" alt="">
                    <div class="card-body">
                        <p>Total Users: 500</p>
                        <p>Free plan</p>
                        <p>Team code : PPG1</p>
                        <p>Contact: <b class="ms-3">Jason west (541) 987-4532</b></p>
                        <p class="fw-bold">Title rep associated : Susan johnson</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card rounded-3 border-0 shadow-sm">
                    <img class="img-fluid" src="{{asset('img/dash/team/t2.png')}}" alt="">
                    <div class="card-body">
                        <p>Total Users: 500</p>
                        <p>Free plan</p>
                        <p>Team code : PPG1</p>
                        <p>Contact: <b class="ms-3">Jason west (541) 987-4532</b></p>
                        <p class="fw-bold">Title rep associated : Susan johnson</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5 pb-5">

        <h3 class="text-center">Premiere Property Group </h3>
        <h3 class="text-center text-primary-light">team code: <b>premiere-property-group</b></h3>

        <div class="row my-4">
            <div class="form-group col-12 col-md-6 col-lg-8 my-1 ">
                <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                    <div class="input-group-prepend border-0 align-self-center">
                        <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">
                            <img class="w-17" src="{{asset('img/menu-icons/search-icon.svg')}}" alt="">
                        </button>
                    </div>
                    <x-input type="text" placeholder="Search Forms by Offerfrom Name" aria-describedby="button-addon4"
                             class="form-control form-control-lg rounded-pill bg-none border-0 search"
                             wire:model="search"/>
                </div>
            </div>
            <div class="form-group col-12 col-md-6 col-lg-4 my-1 btn-group">

                <a href="#" class="btn btn-lg rounded-pill btn-primary-light btn-header fw-bold shadow-sm mx-1 px-2 fs-14"
                   type="button"
                >
                    <img class=" mx-2" width="17" src="{{asset('img/menu-icons/copy-link.svg')}}" alt="">COPY INVITE
                    LINK
                </a>

                <a href="#" class="btn btn-lg rounded-pill btn-primary-light btn-header fw-bold shadow-sm mx-1 px-2 fs-14"
                   type="button"
                >
                    <img class=" mx-2" width="17" src="{{asset('img/menu-icons/fluent-people-white-icon.svg')}}" alt="">INVITE
                    AGENT
                </a>

            </div>
        </div>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-borderless ">
                    <thead>
                    <tr class="border-bottom">
                        <th scope="col">Client Name(s)<img class="w-12 ms-2"
                                                           src="{{asset('img/menu-icons/double-arrow.svg')}}" alt="">
                        </th>
                        <th scope="col">Property Address<img class="w-12 ms-2"
                                                             src="{{asset('img/menu-icons/double-arrow.svg')}}" alt="">
                        </th>
                        <th scope="col">Purchase Price<img class="w-12 ms-2"
                                                           src="{{asset('img/menu-icons/double-arrow.svg')}}" alt="">
                        </th>
                        <th scope="col">Earnest Money<img class="w-12 ms-2"
                                                          src="{{asset('img/menu-icons/double-arrow.svg')}}" alt="">
                        </th>
                        <th scope="col">Closing Date<img class="w-12 ms-2"
                                                         src="{{asset('img/menu-icons/double-arrow.svg')}}" alt=""></th>
                        <th scope="col">Submission Date<img class="w-12 ms-2"
                                                            src="{{asset('img/menu-icons/double-arrow.svg')}}" alt="">
                        </th>
                        <th scope="col">Free Or Paid<img class="w-12 ms-2"
                                                         src="{{asset('img/menu-icons/double-arrow.svg')}}" alt=""></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="fw-500">Ada Lovelace</td>
                        <td class="fw-500">123 Main St. Bend, <p class="mb-0 fs-10">OR 97702</p></td>
                        <td class="fw-500">500,000</td>
                        <td class="fw-500">500,000</td>
                        <td class="fw-500">10/15/2021</td>
                        <td class="fw-500">08/05/21 <span class="fs-10">9:00 AM</span></td>
                        <td class="fw-500"><span class="badge bg-primary ">Free</span></td>
                    </tr>
                    <tr>
                        <td class="fw-500">Ada Lovelace</td>
                        <td class="fw-500">123 Main St. Bend, <p class="mb-0 fs-10">OR 97702</p></td>
                        <td class="fw-500">500,000</td>
                        <td class="fw-500">500,000</td>
                        <td class="fw-500">10/15/2021</td>
                        <td class="fw-500">08/05/21 <span class="fs-10">9:00 AM</span></td>
                        <td class="fw-500"><span class="badge bg-success ">Paid</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{--    Premium popup--}}

    <div class="container">

        <div class="card border-0 py-4">
            <div class="card-body row">
                <div class="d-flex justify-content-between">
                    <h5 class="text-primary-light">Premium Team / Brokerage Plan</h5>
                    <p class="fw-bold">Upgrade to Brokerage Plan</p>
                </div>
                <hr>

                <div class="col-12 col-lg-4">
                    <img class="img-fluid" src="{{asset('img/dash/settings/premium-img.png')}}" alt="">
                </div>
                <div class="col-12 col-lg-4">
                    <p class="fw-bold text-primary-light">Pricing per user</p>
                    <p class="fw-bold text-primary-light">2-25 $15 <span
                            class="text-light text-dark">per month per user</span></p>
                    <p class="fw-bold text-primary-light"> 25+ <span class="text-light text-dark">agents contact us!</span>
                    </p>

                    <a href="" class="btn btn-primary-light px-3 text-uppercase rounded-pill mt-5">Contact us</a>

                </div>
                <div class="col-12 col-lg-4">
                    <p class="fw-bold text-primary-light">
                        You will automatically be billed based on the number of users on your team or brokeragage. If
                        you do not wish to have a user as a premium user on your account, you’ll have access to a team
                        manager dashboard where you can turn on and off premium user accounts. You will also have the
                        ability to invite agents to your account.
                    </p>
                </div>
            </div>
        </div>

        <div class="card border-0 mb-4 pb-5">
            <div class="card-body">
                <h5 class="text-primary-light">Billing</h5>
                <hr>
                <div class="row">
                    <div class="form-group col-12 col-lg-6 mb-3 d-flex justify-content-start">
                        <p class="mb-0 border rounded-circle p-2 fs-18 text-center text-primary-light border-primary-light me-3"
                           style="width: 35px;height: 35px; line-height: 20px">1</p>
                        <p class="mb-0 align-self-center text-capitalize">Billing Info</p>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3 d-flex justify-content-start">
                        <p class="mb-0 border rounded-circle p-2 fs-18 text-center text-primary-light border-primary-light me-3"
                           style="width: 35px;height: 35px; line-height: 20px">2</p>
                        <p class="mb-0 align-self-center text-capitalize">credit card info</p>
                    </div>


                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">Full Name</label>
                        <x-input type="text" class="rounded"/>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">Cardholder name</label>
                        <x-input type="text" class="rounded"/>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">billing address</label>
                        <x-input type="text" class="rounded"/>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">Card Number</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 col-md-6 col-lg-3 mb-3">
                        <label for="" class="fw-bold">City</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 col-md-6 col-lg-3 mb-3">
                        <label for="">ZIP Code</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 col-md-6 col-lg-3 mb-3">
                        <label for="" class="fw-bold">Exp. Month</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 col-md-6 col-lg-3 mb-3">
                        <label for="">Exp. Year</label>
                        <x-input type="text" class="rounded"/>
                    </div>


                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">Country</label>
                        <x-input type="text" class="rounded"/>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">CVC Number</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 my-4 text-end">
                        <x-button class="btn btn-primary-light px-5 ">SUBMIT</x-button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="container my-5 pb-5">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="mb-3">
                    <img class="w-100 rounded-3"
                         src="{{asset('img/dash/dummy-img.jpg')}}"
                         alt="">
                </div>
                <div class="mb-3">
                    <div class="text-start mt-2"
                         x-data="{ isUploadingImage: false, progressImage: 0 }"
                         x-on:livewire-upload-start="isUploadingImage = true"
                         x-on:livewire-upload-finish="isUploadingImage = false;"
                         x-on:livewire-upload-error="isUploadingImage = false"
                         x-on:livewire-upload-progress="progressImage = $event.detail.progress"
                    >
                        <x-input class="form-control form-control-lg" wire:model="image" id="image"
                                 type="file"/>
                        <div class="progress mt-2" x-show="isUploadingImage" style="height: 15px">
                            <div class="progress-bar" role="progressbar" :style="`width: ${progressImage}%`"
                                 x-on:aria-valuenow="progressImage" aria-valuemin="0" aria-valuemax="100"
                                 x-text="`${progressImage}%`"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label class="fw-bold mb-2" for="">Team name</label>
                        <x-input type="text" class=""/>
                    </div>

                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label class="fw-bold mb-2" for="">Contact name</label>
                        <x-input type="text" class=""/>
                    </div>

                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label class="fw-bold mb-2" for="">Email Address</label>
                        <x-input type="text" class=""/>
                    </div>

                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label class="fw-bold mb-2" for="">Manager Password </label>
                        <x-input type="text"/>
                    </div>

                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label class="fw-bold mb-2" for="">Address</label>
                        <x-input type="text"/>
                    </div>


                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label class="fw-bold mb-2" for="">Phone Number </label>
                        <x-input type="text"/>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 mb-3">
                <x-textarea rows="4" placeholder="Notes"></x-textarea>
            </div>

            <div class="form-group col-12 col-md-6  col-lg-4 mb-3">
                <label class="fw-bold mb-2" for="">Total agents</label>
                <x-input type="text" class=""/>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-12 col-md-6 col-lg-3 mx-auto">
                <div class="card bg-transparent text-center border-0 team-pricing-card">
                    <div class="card-body bg-white shadow rounded mb-4">
                        <h5 class="text-primary-light fw-bold mb-3">Team Free</h5>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="$0">
                            <p class="mb-0 ms-2 align-self-center fs-14">/month</p>
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="$0">
                            <p class="mb-0 ms-2 align-self-center fs-14">/year</p>
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="KW124">
                            <p class="mb-0 ms-2 align-self-center fs-14">/Team Code</p>
                        </div>
                    </div>
                    <x-button class="text-uppercase btn btn-primary-light px-5">Current plan</x-button>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto">
                <div class="card bg-transparent text-center border-0 team-pricing-card">
                    <div class="card-body bg-white shadow rounded mb-4">
                        <h5 class="text-primary-light fw-bold mb-3">Team Discount</h5>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="$0">
                            <p class="mb-0 ms-2 align-self-center fs-14">/month</p>
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="$0">
                            <p class="mb-0 ms-2 align-self-center fs-14">/year</p>
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="KW124">
                            <p class="mb-0 ms-2 align-self-center fs-14">/Team Code</p>
                        </div>
                    </div>
                    <x-button class="text-uppercase btn btn-primary-light px-5">Current plan</x-button>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto">
                <div class="card bg-transparent text-center border-0 team-pricing-card">
                    <div class="card-body bg-white shadow rounded mb-4">
                        <h5 class="text-primary-light fw-bold mb-3">Team Premium</h5>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="$0">
                            <p class="mb-0 ms-2 align-self-center fs-14">/month</p>
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="$0">
                            <p class="mb-0 ms-2 align-self-center fs-14">/year</p>
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <input type="text" placeholder="KW124">
                            <p class="mb-0 ms-2 align-self-center fs-14">/Team Code</p>
                        </div>
                    </div>
                    <x-button class="text-uppercase btn btn-primary-light px-5">Current plan</x-button>
                </div>
            </div>
        </div>

        <div class="card border-0 mb-4 pb-5">
            <div class="card-body">
                <h5 class="text-primary-light">Billing</h5>
                <hr>
                <div class="row">
                    <div class="form-group col-12 col-lg-6 mb-3 d-flex justify-content-start">
                        <p class="mb-0 border rounded-circle p-2 fs-18 text-center text-primary-light border-warning me-3"
                           style="width: 35px;height: 35px; line-height: 20px">1</p>
                        <p class="mb-0 align-self-center text-capitalize">Billing Info</p>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3 d-flex justify-content-start">
                        <p class="mb-0 border rounded-circle p-2 fs-18 text-center text-primary-light border-warning me-3"
                           style="width: 35px;height: 35px; line-height: 20px">2</p>
                        <p class="mb-0 align-self-center text-capitalize">credit card info</p>
                    </div>


                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">Full Name</label>
                        <x-input type="text" class="rounded"/>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">Cardholder name</label>
                        <x-input type="text" class="rounded"/>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">billing address</label>
                        <x-input type="text" class="rounded"/>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">Card Number</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 col-md-6 col-lg-3 mb-3">
                        <label for="" class="fw-bold">City</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 col-md-6 col-lg-3 mb-3">
                        <label for="">ZIP Code</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 col-md-6 col-lg-3 mb-3">
                        <label for="" class="fw-bold">Exp. Month</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 col-md-6 col-lg-3 mb-3">
                        <label for="">Exp. Year</label>
                        <x-input type="text" class="rounded"/>
                    </div>


                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">Country</label>
                        <x-input type="text" class="rounded"/>
                    </div>
                    <div class="form-group col-12 col-lg-6 mb-3">
                        <label for="">CVC Number</label>
                        <x-input type="text" class="rounded"/>
                    </div>

                    <div class="form-group col-12 my-4 text-end">
                        <x-button class="btn btn-primary-light px-5 ">SUBMIT</x-button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{--    <div class="container my-5 pb-5">--}}

    {{--        --}}{{--        Change User's Plan --}}

    {{--        --}}{{--        <div class="row mb-5">--}}
    {{--        --}}{{--            <h5 class="fw-bold">--}}
    {{--        --}}{{--                <img class="rounded-circle rounded-icon shadow-sm me-2" src="{{asset('img/agent/icons/map.svg')}}"--}}
    {{--        --}}{{--                     alt="">--}}
    {{--        --}}{{--                Demo Address--}}
    {{--        --}}{{--            </h5>--}}
    {{--        --}}{{--            <div class="col-12 col-lg-6">--}}
    {{--        --}}{{--                <div class="thumbnail my-2">--}}
    {{--        --}}{{--                    <img class="img-fluid" src="{{asset('img/agent/completed-offerforms/cof2.png')}}" alt="">--}}
    {{--        --}}{{--                </div>--}}
    {{--        --}}{{--            </div>--}}
    {{--        --}}{{--            <div class="col-12 col-lg-6">--}}
    {{--        --}}{{--                <div class="card border-0 py-4 shadow">--}}
    {{--        --}}{{--                    <div class="card-body">--}}
    {{--        --}}{{--                        <div class="row mb-1 ">--}}
    {{--        --}}{{--                            <div class="col-4">--}}
    {{--        --}}{{--                                <ul class="fa-ul">--}}
    {{--        --}}{{--                                    <li><span class="fa-li"><i class="fa fa-user fs-20 text-primary"></i>--}}
    {{--        --}}{{--                                    </span><a href="#" class="text-decoration-none fs-16 text-dark fw-bold">Buyer :</a>--}}
    {{--        --}}{{--                                    </li>--}}
    {{--        --}}{{--                                </ul>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                            <div class="col-8">--}}
    {{--        --}}{{--                                <p class="mb-0">Demo Customer</p>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                        </div>--}}
    {{--        --}}{{--                        <div class="row mb-1 ">--}}
    {{--        --}}{{--                            <div class="col-4">--}}
    {{--        --}}{{--                                <ul class="fa-ul">--}}
    {{--        --}}{{--                                    <li><span class="fa-li"><i class="fa fa-envelope fs-20 text-primary"></i>--}}
    {{--        --}}{{--                                    </span><a href="#" class="text-decoration-none fs-16 text-dark fw-bold">Buyer Email--}}
    {{--        --}}{{--                                            :</a></li>--}}
    {{--        --}}{{--                                </ul>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                            <div class="col-8">--}}
    {{--        --}}{{--                                <p class="mb-0"><a href="#" class="text-decoration-none text-dark">demo220228041112215@gmail.com</a>--}}
    {{--        --}}{{--                                </p>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                        </div>--}}
    {{--        --}}{{--                        <div class="row mb-1 ">--}}
    {{--        --}}{{--                            <div class="col-4">--}}
    {{--        --}}{{--                                <ul class="fa-ul">--}}
    {{--        --}}{{--                                    <li><span class="fa-li"><i class="fa fa-birthdat-cake fs-20 text-primary"></i>--}}
    {{--        --}}{{--                                    </span><a href="#" class="text-decoration-none fs-16 text-dark fw-bold">Buyer Phone--}}
    {{--        --}}{{--                                            :</a></li>--}}
    {{--        --}}{{--                                </ul>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                            <div class="col-8">--}}
    {{--        --}}{{--                                <p class="mb-0"></p>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                        </div>--}}
    {{--        --}}{{--                        <div class="row mb-1 ">--}}
    {{--        --}}{{--                            <div class="col-4">--}}
    {{--        --}}{{--                                <ul class="fa-ul">--}}
    {{--        --}}{{--                                    <li><span class="fa-li"><i class="fa fa-birthday-cake fs-20 text-primary"></i>--}}
    {{--        --}}{{--                                    </span><a href="#" class="text-decoration-none fs-16 text-dark fw-bold">Buyer Phone--}}
    {{--        --}}{{--                                            :</a></li>--}}
    {{--        --}}{{--                                </ul>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                            <div class="col-8">--}}
    {{--        --}}{{--                                <p class="mb-0"></p>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                        </div>--}}
    {{--        --}}{{--                        <div class="row mb-1 ">--}}
    {{--        --}}{{--                            <div class="col-4">--}}
    {{--        --}}{{--                                <ul class="fa-ul">--}}
    {{--        --}}{{--                                    <li><span class="fa-li"><i class="fa fa-user fs-20 text-primary"></i>--}}
    {{--        --}}{{--                                    </span><a href="#" class="text-decoration-none fs-16 text-dark fw-bold">Buyer Phone--}}
    {{--        --}}{{--                                            :</a></li>--}}
    {{--        --}}{{--                                </ul>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                            <div class="col-8">--}}
    {{--        --}}{{--                                <p class="mb-0"></p>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                        </div>--}}
    {{--        --}}{{--                        <div class="row mb-1 ">--}}
    {{--        --}}{{--                            <div class="col-4">--}}
    {{--        --}}{{--                                <ul class="fa-ul">--}}
    {{--        --}}{{--                                    <li><span class="fa-li"><i class="fa fa-birthday-cake fs-20 text-primary"></i>--}}
    {{--        --}}{{--                                    </span><a href="#" class="text-decoration-none fs-16 text-dark fw-bold">Buyer Phone--}}
    {{--        --}}{{--                                            :</a></li>--}}
    {{--        --}}{{--                                </ul>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                            <div class="col-8">--}}
    {{--        --}}{{--                                <p class="mb-0"></p>--}}
    {{--        --}}{{--                            </div>--}}
    {{--        --}}{{--                        </div>--}}

    {{--        --}}{{--                    </div>--}}
    {{--        --}}{{--                </div>--}}
    {{--        --}}{{--            </div>--}}
    {{--        --}}{{--        </div>--}}

    {{--        --}}{{--        <div class="card border-0 mb-4">--}}
    {{--        --}}{{--            <div class="card-body">--}}
    {{--        --}}{{--                <h4 class="text-primary-light fw-bold">ANOTHER CUSTOM STEP</h4>--}}
    {{--        --}}{{--                <hr>--}}
    {{--        --}}{{--                <div class="row">--}}
    {{--        --}}{{--                    <div class="col-12 col-lg-6">--}}
    {{--        --}}{{--                        <p>What is the Property Address You’d Like to Make an Offer on?</p>--}}
    {{--        --}}{{--                        <p>What is the Property Address You’d Like to Make an Offer on?</p>--}}
    {{--        --}}{{--                    </div>--}}
    {{--        --}}{{--                    <div class="col-12 col-lg-6 text-start text-lg-end">--}}
    {{--        --}}{{--                        <p class="fw-bold">some text here</p>--}}
    {{--        --}}{{--                    </div>--}}
    {{--        --}}{{--                </div>--}}
    {{--        --}}{{--            </div>--}}
    {{--        --}}{{--        </div>--}}
    {{--        --}}{{--        <div class="card border-0 mb-4">--}}
    {{--        --}}{{--            <div class="card-body">--}}
    {{--        --}}{{--                <h4 class="text-primary-light fw-bold">ANOTHER CUSTOM STEP</h4>--}}
    {{--        --}}{{--                <hr>--}}
    {{--        --}}{{--                <div class="row">--}}
    {{--        --}}{{--                    <div class="col-12 col-lg-6">--}}
    {{--        --}}{{--                        <p>What is the Property Address You’d Like to Make an Offer on?</p>--}}
    {{--        --}}{{--                        <p>What is the Property Address You’d Like to Make an Offer on?</p>--}}
    {{--        --}}{{--                    </div>--}}
    {{--        --}}{{--                    <div class="col-12 col-lg-6 text-start text-lg-end">--}}
    {{--        --}}{{--                        <p class="fw-bold">some text here</p>--}}
    {{--        --}}{{--                    </div>--}}
    {{--        --}}{{--                </div>--}}
    {{--        --}}{{--            </div>--}}
    {{--        --}}{{--        </div>--}}

    {{--    </div>--}}

</x-app-layout>
