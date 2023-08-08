<x-app-layout xmlns="http://www.w3.org/1999/html">

    <x-slot name="header">
        <div class="container mt-3">
            <a href="{{route('dash.referral-partners.index', $referralPartnerType->slug)}}" class="btn btn-lg rounded-pill bg-white btn-header px-5 fw-bold shadow-sm mx-1 fs-14">
                Back
            </a>
        </div>
    </x-slot>

    <div class="container my-4">
        <div class="card border-0 mb-3 shadowsm p-3">
            <div class="card-body">
                <h5 class="fw-bold">Home Insurance Partner Create</h5>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                <form wire:submit.prevent="submit">
                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <img class="w-100 rounded-3" src="{{asset('img/dash/settings/setting-profile.jpg')}}" alt="">
                            </div>
                            <div>
                                <x-input class="form-control form-control-lg" id="formFileLg" type="file"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="row">

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Name</label>
                                    <x-input type="text" class="py-3" placeholder="Name"/>
                                </div>


                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Company Name</label>
                                    <x-input type="text" class="py-3" placeholder="Company Name"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Email Address</label>
                                    <x-input type="text" class="py-3" placeholder="Email Address"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Phone Number</label>
                                    <x-input type="text" class="py-3" placeholder="Phone Number"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Date of first service</label>
                                    <x-input type="date" class="py-3"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for=""> States Serviced</label>
                                    <x-input type="text" class="py-3" placeholder="States Serviced"/>
                                </div>

                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for=""> Address</label>
                                    <x-input type="text" class="py-3" placeholder="Address"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">City</label>
                                    <x-input type="text" class="py-3" placeholder="City"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for=""> State</label>
                                    <x-input type="text" class="py-3" placeholder="State"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for=""> Zip Code</label>
                                    <x-input type="text" class="py-3" placeholder="Zip Code"/>
                                </div>


                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for=""> Notes</label>
                                    <x-textarea type="text" class="py-3" placeholder="Notes"/>
                                    </textarea>
                                </div>

                                <div class="form-group mt-2 text-right">
                                    <x-button type="submit"
                                              class="btn-primary px-5 py-3 me-md-4 me-lg-4 text-uppercase shadow-sm">
                                        <div wire:loading.remove wire:target="submit">
                                            Submit
                                        </div>
                                        <div wire:loading wire:target="submit">
                                            Submitting...
                                        </div>
                                    </x-button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
