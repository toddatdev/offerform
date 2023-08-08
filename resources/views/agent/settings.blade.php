<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="container">
        <div class="card border-0 mb-4 shadowsm p-3">
            <div class="card-body">
                <h4 class="fw-bold text-primary-light">Edit Profile </h4>
                <hr>
                <form action="">
                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Profile Picture</h5>
                                <img class="w-100 rounded-3"
                                     src="{{asset('img/dash/settings/setting-profile.jpg')}}" alt="">
                            </div>

                            <div class="mb-5">
                                <x-input class="form-control form-control-lg" id="formFileLg" type="file"/>
                            </div>

                            {{--                            Video link--}}

                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Agent About Video</h5>
                                <img class="w-100 rounded-3"
                                     src="{{asset('img/dash/settings/setting-profile-video.jpg')}}" alt="">
                            </div>

                            <div class="mb-3">
                                <x-input class="form-control form-control-lg" id="formFileLg" type="file"/>
                            </div>


                        </div>
                        <div class="col-12 col-lg-8">
                            <h5 class="fw-bold mb-3">Profile Information</h5>
                            <div class="row">
                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">First Name</label>
                                    <x-input type="text" class="py-3" placeholder="John"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Last Name</label>
                                    <x-input type="text" class="py-3" placeholder="Doe"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Email</label>
                                    <x-input type="text" class="py-3" placeholder="admin@app.com"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Transaction Coordinator Email</label>
                                    <x-input type="text" class="py-3" placeholder="admin@app.com"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Phone Number</label>
                                    <x-input type="text" class="py-3" placeholder="123456789"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">License #</label>
                                    <x-input type="text" class="py-3" placeholder="42142"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Position</label>
                                    <x-input type="text" class="py-3" placeholder=""/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Brokerage Name</label>
                                    <x-input type="text" class="py-3" placeholder=""/>
                                </div>

                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for="">address</label>
                                    <x-input type="text" class="py-3" placeholder="Street#1234 USA"/>
                                </div>


                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for="">Agent Bio</label>
                                    <x-textarea class="form-control" id="" rows="7"></x-textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-7 ">
                            <p class="mb-0">Or Enter video url</p>
                            <div class="form-group">
                                <x-input type="text" placeholder="Enter Video url"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="form-group mt-2 text-end">
                                <a type="button" class="btn btn-lg shadow-sm px-5 rounded-pill btn-setting-light">Update
                                    Profile</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="card border-0 mb-4 shadow-sm p-3">
            <div class="card-body">
                <h4 class="fw-bold text-primary-light">Social media</h4>
                <hr>

                <div class="row mb-4">
                    <div class="col-12 col-lg-3">
                        <div class="socialicon">
                            <i class="fa fa-facebook fa-2x text-white rounded-circle "
                               style="background-color: #3b5998"></i>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <x-input type="text" class="" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">

                        <div class="button text-end">
                            <a href="" class="btn btn-lg shadow-sm px-5 rounded-pill btn-setting-light">Button</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12 col-lg-3">
                        <div class="socialicon">
                            <i class="fa fa-instagram fa-2x text-white rounded-circle "
                               style="background-color: #c32aa3"></i>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <x-input type="text" class="" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">

                        <div class="button text-end">
                            <a href="" class="btn btn-lg shadow-sm px-5 rounded-pill btn-setting-light">Button</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12 col-lg-3">
                        <div class="socialicon">
                            <i class="fa fa-twitter fa-2x text-white rounded-circle "
                               style="background-color: #55acee"></i></div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <x-input type="text" class="" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">

                        <div class="button text-end">
                            <a href="" class="btn btn-lg shadow-sm px-5 rounded-pill btn-setting-light">Button</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12 col-lg-3">
                        <div class="socialicon">
                            <i class="fa fa-youtube fa-2x text-white rounded-circle "
                               style="background-color: #FF0000"></i></div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <x-input type="text" class="" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">

                        <div class="button text-end">
                            <a href="" class="btn btn-lg shadow-sm px-5 rounded-pill btn-setting-light">Button</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card border-0 mb-4 shadowsm p-3">
            <div class="card-body">
                <h4 class="fw-bold text-primary-light">Integrations</h4>
                <hr>
                <div class="row mb-4">
                    <div class="col-12 col-lg-3">
                        <div class="socialicon">
                            <img class="img-fluid" src="{{asset('img/dash/settings/zapier.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <x-input type="text" class="" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">

                        <div class="button text-end">
                            <a href="" class="btn btn-lg shadow-sm px-5 rounded-pill btn-setting-light">Button</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="my-5 py-4 pricing">
            <div class="text-center row">
                <h1 class="h1">Pricing Plan</h1>
                <h5>Choose the plan that's right for your growing team!</h5>
                <div class="inner col-12 mx-auto tabsBtnHolder my-4">
                    <div class="btn-group bg-primary rounded-pill px-0 shadow" role="group" aria-label="Basic example">
                        <button id="monthly" type="button"
                                class="active btn subscription  px-5 text-white py-3 rounded-pill">Monthly
                        </button>
                        <button id="yearly" type="button" class="btn  rounded-pill  subscription text-white px-5 py-3">
                            Yearly
                        </button>
                    </div>
                </div>
            </div>

            <div class="row monthlyPriceList animated my-5 py-3">
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0">
                    <div class="col mx-2 py-5" style="background-color: #5a1e9a">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 ">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary">$0 <span class="fs-14 text-dark">/month</span></h4>
                                    <h3 class="text-uppercase fw-bold mb-0">Free plan</h3>
                                    <p>NO CREDIT CARD REQUIRED</p>
                                </div>
                                <hr>

                                <ul class="list-group list-group-flush pb-4">
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Unlimited offers</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Premed Offer Form templates</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Buyer education</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Real-time mortgage calculator</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Sync client info to your CRM</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Export offer information with Zapier integration</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Custom Form Builder</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2"> Upload personal videos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href=""
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover pb-3 rounded-pill btn-header">
                            Get Started
                            <span class="mx-2">
                                <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                        </span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0">
                    <div class="col mx-2 py-5" style="background-color: #786ade">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 ">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary">$10 <span class="fs-14 text-dark">/month</span></h4>
                                    <h3 class="text-uppercase fw-bold mb-0">PREMIUM PLAN</h3>
                                </div>

                                <hr>

                                <ul class="list-group list-group-flush pb-4">
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Unlimited offers</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Premed Offer Form templates</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Buyer education</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Real-time mortgage calculator</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Sync client info to your CRM</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Export offer information with Zapier integration</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Custom Form Builder</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2"> Upload personal videos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href=""
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover pb-3 rounded-pill btn-header">
                            Get Started
                            <span class="mx-2">
                                <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                        </span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0">
                    <div class="col mx-2 py-5" style="background-color: #c67eff">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 ">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary"><span class="fs-14 text-dark"></span></h4>
                                    <h3 class="text-uppercase fw-bold mb-0">TEAM/BROKERAGE PLAN</h3>
                                    <p></p>
                                </div>
                                <hr>

                                <ul class="list-group list-group-flush pb-4">
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Unlimited offers</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Premed Offer Form templates</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Buyer education</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Real-time mortgage calculator</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Sync client info to your CRM</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Export offer information with Zapier integration</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Custom Form Builder</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2"> Upload personal videos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href=""
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover pb-3 rounded-pill btn-header">
                            Get Started
                            <span class="mx-2">
                                <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                        </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row yearlyPriceList d-none animated my-5 py-3">
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0">
                    <div class="col mx-2 py-5" style="background-color: #5a1e9a ">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 ">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary">$0 <span class="fs-14 text-dark">/annually</span></h4>
                                    <h3 class="text-uppercase fw-bold mb-0">Free plan</h3>
                                    <p>NO CREDIT CARD REQUIRED</p>
                                </div>
                                <hr>

                                <ul class="list-group list-group-flush pb-4">
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Unlimited offers</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Premed Offer Form templates</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Buyer education</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Real-time mortgage calculator</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Sync client info to your CRM</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Export offer information with Zapier integration</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Custom Form Builder</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2"> Upload personal videos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href=""
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover pb-3 rounded-pill btn-header">
                            Get Started
                            <span class="mx-2">
                                <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                        </span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0">
                    <div class="col mx-2 py-5" style="background-color: #786ade">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 ">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary">470 <span class="fs-14 text-dark">/annually</span></h4>
                                    <h3 class="text-uppercase fw-bold mb-0">PREMIUM PLAN</h3>
                                </div>

                                <hr>

                                <ul class="list-group list-group-flush pb-4">
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Unlimited offers</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Premed Offer Form templates</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Buyer education</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Real-time mortgage calculator</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Sync client info to your CRM</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Export offer information with Zapier integration</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Custom Form Builder</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2"> Upload personal videos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href=""
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover pb-3 rounded-pill btn-header">
                            Get Started
                            <span class="mx-2">
                                <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                        </span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0">
                    <div class="col mx-2 py-5" style="background-color: #c67eff">
                        <div class="card pricing-card py-5 p-3 shadow border-0 rounded-0 ">
                            <div class="card-body">
                                <div class="" style="height: 100px">
                                    <h4 class="text-primary"><span class="fs-14 text-dark"></span></h4>
                                    <h3 class="text-uppercase fw-bold mb-0">TEAM/BROKERAGE PLAN</h3>
                                    <p></p>
                                </div>
                                <hr>

                                <ul class="list-group list-group-flush pb-4">
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Unlimited offers</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Premed Offer Form templates</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Buyer education</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Real-time mortgage calculator</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Sync client info to your CRM</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Export offer information with Zapier integration</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2">Custom Form Builder</span>
                                    </li>
                                    <li class="list-group-item border-0"><i
                                            class="fa fa-check bg-light text-primary p-1 rounded-circle"></i> <span
                                            class="mx-2"> Upload personal videos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href=""
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover pb-3 rounded-pill btn-header">
                            Get Started
                            <span class="mx-2">
                                <img class="img-fluid" src="{{asset('img/guest/home/arrow.png')}}" alt="">
                        </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>


    @push('scripts')

        <script>
            $(document).ready(function (){
                $(".subscription").click(function () {
                    // remove classname 'active' from all li who already has classname 'active'
                    $(".subscription.active").removeClass("active");
                    // adding classname 'active' to current click li
                    $(this).addClass("active");
                });

                // Subscriptions

                $("#monthly").click(function () {
                    $(this).addClass('active');
                    $("#yearly").removeClass('active')

                    $(".monthlyPriceList").removeClass('d-none');
                    $(".monthlyPriceList").addClass('fadeIn');
                    $(".yearlyPriceList").addClass('d-none');

                    $(".indicator").css("left", "2px");
                })

                $("#yearly").click(function () {
                    $(this).addClass('active');
                    $("#monthly").removeClass('active');

                    $(".yearlyPriceList").removeClass('d-none');
                    $(".yearlyPriceList").addClass('fadeIn');
                    $(".monthlyPriceList").addClass('d-none');

                    $(".indicator").css("left", "163px");
                })

            });
        </script>

    @endpush

</x-app-layout>
