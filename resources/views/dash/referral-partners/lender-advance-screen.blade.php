{{--@include("dash.referral-partners.{$referralPartnerType->slug}")--}}
<x-app-layout>

    <div class="container my-3 ">
        <div class="d-gird gap-4 mb-3">
            <a href="{{route('dash.referral-partners.partner-list')}}" class="btn btn-lg w-150 btn-white-black-hover btn-hover-white-img me-2
            fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill" type="button">
                <i class="fa fa-angle-left fs-20 me-3"></i>Back
            </a>
            <a href="#"
               class="btn btn-lg w-150 btn-white-black-hover mb-2 btn-hover-white-img fw-500 shadow-sm me-2 my-2 my-lg-0 fs-14 rounded-pill text-uppercase">
                <img class="w-22 pe-2" src="{{asset('img/menu-icons/red-trash.svg')}}" alt="">Delete
            </a>

        </div>
    </div>

    <div class="container my-4">
        <div class="card border-0 mb-4 shadowsm p-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12 col-md-6">
                        <h5 class="fw-bold text-primary-light">*Referral Partner Type Name Here*</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <h5 class="fw-bold">Referral Partner Contact Info</h5>
                    </div>
                </div>

                <form>
                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <img class="w-100 rounded-3" src="{{asset('img/dash/settings/setting-profile.jpg')}}"
                                     alt="">
                            </div>
                            <div>
                                <x-input class="form-control form-control-lg" id="formFileLg" type="file"/>
                            </div>
{{--                            <x-profile-photo wire:model="photo" :user="$user"/>--}}
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="form-group col-12 mb-3">
                                    <label class="fw-bold mb-2" for="">Company Name</label>
                                    <x-input type="text" class="py-3" />
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">First Name</label>
                                    <x-input type="text" class="py-3" />
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Last Name</label>
                                    <x-input type="text" class="py-3" />
                                </div>


                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Email Address</label>
                                    <x-input type="text" class="py-3"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Phone Number</label>
                                    <x-input type="text" class="py-3"/>
                                </div>

                                <div class="form-group col-12 col-lg-4 mb-3">
                                    <label class="fw-bold mb-2" for="">Date of First Service</label>
                                    <x-input type="date" class="py-3"/>
                                </div>

                                <div class="form-group col-12 col-lg-8 mb-3">
                                    <label class="fw-bold mb-2" for=""> Address</label>
                                    <x-input type="text" class="py-3"/>
                                </div>

                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for=""> Notes</label>
                                    <x-textarea type="text" class="py-3" />
                                    </textarea>
                                </div>


                                <div class="form-group mt-2 text-end">
                                    <x-button type="submit"
                                              class="btn-primary-light px-5 rounded-3 py-2 text-uppercase shadow-sm">
                                        <div>
                                            Save
                                        </div>
{{--                                        <div wire:loading wire:target="submit">--}}
{{--                                            Saving...--}}
{{--                                        </div>--}}
                                    </x-button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

{{--        @include('profile.agent.integrations-form')--}}

        <div class="card border-0 mb-4 shadow-sm p-3">
            <div class="card-body">
                <h6 class="fw-bold">Service Areas - <span class="fw-500">Select referral partners service area by State, County, Zip Code, or City</span>
                </h6>
                <div class="row mt-4 mb-2">
                    <div class="col-12 col-md-6 col-lg-3 mx-auto">
                        <div class="form-group mb-3 px-3">
                            <label for="" class="fw-bold">State</label>
                            <x-select name="" class="select-icon" id="">
                                <option value="">...</option>
                                <option value="">...</option>
                                <option value="">...</option>
                            </x-select>
                            <div class="d-flex justify-content-between mt-2 mt-md-3">
                                <p class="mb-0 fw-bold">State Only</p>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                       style="height: 18px;width: 18px">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mx-auto">
                        <div class="form-group mb-3 px-3">
                            <label for="" class="fw-bold">City</label>
                            <x-select name="" class="select-icon" id="">
                                <option value="">...</option>
                                <option value="">...</option>
                                <option value="">...</option>
                            </x-select>
                            <div class="d-flex justify-content-between mt-2 mt-md-3">
                                <p class="mb-0 fw-bold">City Only</p>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                       style="height: 18px;width: 18px">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mx-auto">
                        <div class="form-group mb-3 px-3">
                            <label for="" class="fw-bold">Zip Code</label>
                            <x-select name="" class="select-icon" id="">
                                <option value="">...</option>
                                <option value="">...</option>
                                <option value="">...</option>
                            </x-select>
                            <div class="d-flex justify-content-between mt-2 mt-md-3">
                                <p class="mb-0 fw-bold">Zip Code Only</p>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                       style="height: 18px;width: 18px">
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-4 ">
                        <a href="#" class="btn btn-lg btn-primary-light px-5 rounded-3 ">SAVE</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Referral Partner Screen--}}
        <div class="card border-0 mb-4 shadow-sm p-3">
            <div class="card-body text-center">
                <h5 class="fw-bold text-center mb-4">Edit Referral Partner Screen <i class="fa fa-lock ms-2"></i></h5>
                <div class="btn-group mt-4" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary-light mx-3 rounded-3 w-210 btn-sm-100 mb-3 mb-lg-0">
                        <img src="{{asset('img/dash/offer-forms/white-edit.svg')}}" class="w-15 me-2" alt="">Edit Screen
                    </button>
                    <button type="button" class="btn btn-primary-light mx-3 rounded-3 w-210 btn-sm-100 mb-3 mb-lg-0">
                        <img src="{{asset('img/menu-icons/eye-icon.svg')}}" class="w-16 me-2" alt="">Preview Screen
                    </button>
                </div>
            </div>
        </div>

        <div class="card border-0 mb-4 shadow-sm p-3">
            <div class="card-body">
              <div class="d-flex justify-content-start">
                  <h6 class="fw-bold align-self-center me-4 pt-1">Bill per Lead</h6>
                  <input class="form-check-input ms-4 check-filled" type="checkbox" value=""
                         id="flexCheckChecked" style="height: 18px;width: 18px">
              </div>
                <div class="row mt-4 mb-2">
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="form-group px-3">
                            <label for="" class="fw-bold">Cost Per Lead</label>
                            <div class="input-group">
                                <div class="input-group-text bg-transparent border-end-0 fw-bold" id="btnGroupAddon2">$
                                </div>
                                <input class="form-control form-control-lg border-start-0 fw-bold text-end outline-none ph-16" type="text" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-group mb-3 px-3">
                            <label for="" class="fw-bold">Total Number of leads sent </label>
                            <x-input class="bg-primary-light text-white text-end ph-white-text-right ph-16"  placeholder="0"/>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="form-group px-3">
                            <label for="" class="fw-bold">Total Monthly Charge</label>
                            <div class="input-group ">
                                <div class="input-group-text border-end-0 fw-bold bg-primary-light text-white white-placeholder" id="btnGroupAddon2">$
                                </div>
                                <input class="form-control form-control-lg border-start-0 fw-bold ph-16 bg-primary-light text-white ph-white-text-right text-end outline-none"
                                       type="text" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="form-group px-3">
                            <label for="" class="fw-bold">Monthly payment Due Date</label>
                                <input class="form-control form-control-lg fw-bold text-center outline-none"
                                       type="date" placeholder="200">
                        </div>
                    </div>

                    <div class="text-end mt-4 ">
                        <a href="#" class="btn btn-lg btn-primary-light px-5 rounded-3 ">SAVE</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="card border-0 mb-4 shadow-sm p-3">
            <div class="card-body">
              <div class="d-flex justify-content-start">
                  <h6 class="fw-bold align-self-center me-4 pt-1">Bill per Month</h6>
                  <input class="form-check-input ms-4" type="checkbox" value=""
                         id="flexCheckChecked" style="height: 18px;width: 18px">
              </div>
                <div class="row mt-4 mb-2">
                    <div class="col-12 col-md-6 col-lg-3 offset-lg-3 mb-3">
                        <div class="form-group px-3">
                            <label for="" class="fw-bold">Cost Per Lead</label>
                            <div class="input-group">
                                <div class="input-group-text bg-transparent border-end-0 fw-bold" id="btnGroupAddon2">$
                                </div>
                                <input class="form-control form-control-lg border-start-0 fw-bold text-end outline-none ph-16" type="text" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3  mb-3">
                        <div class="form-group px-3">
                            <label for="" class="fw-bold">Monthly payment due Date</label>
                                <input class="form-control form-control-lg fw-bold text-center outline-none"
                                       type="date" placeholder="200">
                        </div>
                    </div>

                    <div class="text-end mt-4 ">
                        <a href="#" class="btn btn-lg btn-primary-light px-5 rounded-3 ">SAVE</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="card border-0 mb-4 shadow-sm p-3">
            <div class="card-body row">
                <div class="col-12 col-lg-6">
                    <h5 class="fw-bold mb-3 text-capitalize">billing info via credit card</h5>
                  <div class="row">
                      <div class="form-group mb-3 col-12 ">
                          <label for="">Name on Card</label>
                          <x-input type="text" />
                      </div>
                      <div class="form-group mb-3 col-12 ">
                          <label for="">Card Number</label>
                          <x-input type="text" />
                      </div>
                      <div class="form-group mb-3 col-12 col-lg-6">
                          <label for="" class="fw-bold">Exp. Date</label>
                          <x-input type="date" />
                      </div>
                      <div class="form-group mb-3 col-12 col-lg-6">
                          <label for="">Security Code</label>
                          <x-input type="text" />
                      </div>
                      <div class="form-group mb-3 col-12 ">
                          <label for="">ZIP/Postal Code</label>
                          <x-input type="text" />
                      </div>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                    <h5 class="fw-bold mb-3 text-capitalize">bill Via Bank Account</h5>
                    <div class="row">
                        <div class="form-group mb-3 col-12 ">
                            <label for="">Name on Account</label>
                            <x-input type="text" />
                        </div>
                        <div class="form-group mb-3 col-12 ">
                            <label for="">Account Number</label>
                            <x-input type="text" />
                        </div>
                        <div class="form-group mb-3 col-12 ">
                            <label for="">Routing Number</label>
                            <x-input type="text" />
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4 ">
                    <a href="#" class="btn btn-lg btn-primary-light px-5 rounded-3 ">SAVE</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
