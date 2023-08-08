<x-app-layout xmlns="http://www.w3.org/1999/html">

    <x-slot name="header">
        <div class="container mt-3">
            <a href="{{route('dash.referral-partners.index', $referralPartnerType->slug)}}"
               class="btn btn-lg rounded-pill bg-white btn-header px-5 fw-bold shadow-sm mx-1 fs-14">
                Back
            </a>
        </div>
    </x-slot>

    <div class="container my-4"  wire:key="{{ $referralPartnerType->slug }}">
        <div class="card border-0 mb-3 shadow-sm p-3">
            <div class="card-body">
                <h5 class="fw-bold">Title Partner Create</h5>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                <form wire:submit.prevent="submit">
                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                @if($logo)
                                    <img class="w-100 rounded-3" src="{{ $logo->temporaryUrl() }}" alt="{{ $referralPartner ? $referralPartner->fname : '' }}" />
                                @elseif($referralPartner)
                                    <img class="w-100 rounded-3" src="{{ asset("storage/$referralPartner->logo") }}" alt="{{ $referralPartner ? $referralPartner->fname : ''}}" />
                                @endif
                            </div>
                            <div>
                                <x-input class="form-control form-control-lg" id="formFileLg" type="file" wire:model="logo"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Company Name</label>
                                    <x-input type="text" class="py-3" placeholder="Company Name" wire:model="referralPartner.company_name"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Service city's</label>
                                    <x-input type="text" class="py-3" placeholder="Service city's" wire:model="referralPartner.service_city"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">First Name</label>
                                    <x-input type="text" class="py-3" placeholder="First Name" wire:model="referralPartner.fname"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Last Name</label>
                                    <x-input type="text" class="py-3" placeholder="Last Name" wire:model="referralPartner.lname"/>
                                </div>


                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Email Address</label>
                                    <x-input type="text" class="py-3" placeholder="Email Address" wire:model="referralPartner.company_email"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Phone Number</label>
                                    <x-input type="text" class="py-3" placeholder="Phone Number" wire:model="referralPartner.company_phone"/>
                                </div>

                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for=""> Address</label>
                                    <x-input type="text" class="py-3" placeholder="Address" wire:model="referralPartner.company_address"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">City</label>
                                    <x-input type="text" class="py-3" placeholder="City" wire:model="referralPartner.company_city"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for=""> State</label>
                                    <x-input type="text" class="py-3" placeholder="State" wire:model="referralPartner.company_state"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for=""> Zip Code</label>
                                    <x-input type="text" class="py-3" placeholder="Zip Code" wire:model="referralPartner.company_zip_code"/>
                                </div>


                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for=""> Bio</label>
                                    <x-textarea type="text" class="py-3" placeholder="Bio" wire:model="referralPartner.company_bio"/>
                                </div>

                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for=""> Notes</label>
                                    <x-textarea type="text" class="py-3" placeholder="Notes" wire:model="referralPartner.notes"/>
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
