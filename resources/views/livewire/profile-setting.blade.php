
<div>
    @hasanyrole('super-admin|admin')
        <div class="container">
        <div class="card border-0 mb-3 shadowsm p-3">
            <div class="card-body">
                <h5 class="fw-bold">General settings page for the owner admin</h5>
                <form action="">
                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <img class="w-100 rounded-3"
                                     src="{{ $this->image ? $this->temporaryUrl() : ($user->image ? asset("storage/$user->image") : asset('img/dash/settings/setting-profile.jpg')) }}"
                                     alt="">
                            </div>
                            <div class="mb-5 position-relative">
                                <label for="" class="position-absolute file-upload-label change-img">
                                    <img class="w-18 me-3" src="{{ asset('img/menu-icons/upload-icon.svg') }}" alt="">
                                    Change Image
                                </label>
                                <div class="text-start mt-2"
                                     x-data="{ isUploadingImage: false, progressImage: 0 }"
                                     x-on:livewire-upload-start="isUploadingImage = true"
                                     x-on:livewire-upload-finish="isUploadingImage = false;"
                                     x-on:livewire-upload-error="isUploadingImage = false"
                                     x-on:livewire-upload-progress="progressImage = $event.detail.progress"
                                >
                                    <x-input class="form-control form-control-lg upload-change-img"
                                             wire:model="image" id="image"
                                             type="file"/>
                                    <div class="progress mt-2" x-show="isUploadingImage" style="height: 15px">
                                        <div class="progress-bar" role="progressbar"
                                             :style="`width: ${progressImage}%`"
                                             x-on:aria-valuenow="progressImage" aria-valuemin="0"
                                             aria-valuemax="100"
                                             x-text="`${progressImage}%`"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">First Name</label>
                                    <x-input type="text" class="py-3" placeholder="John" wire:model="fname"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Last Name</label>
                                    <x-input type="text" class="py-3" placeholder="Doe" wire:model="lname"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Email</label>
                                    <x-input type="text" class="py-3" placeholder="admin@app.com"
                                             wire:model="user.email"/>
                                </div>

                                <div class="form-group col-12 col-lg-6 mb-3">
                                    <label class="fw-bold mb-2" for="">Contact Phone</label>
                                    <x-input type="text" class="py-3" placeholder="123456789" wire:model="user.phone"/>
                                </div>

                                <div class="form-group col-12 col-lg-12 mb-3">
                                    <label class="fw-bold mb-2" for="">Contact address</label>
                                    <x-input type="text" class="py-3" placeholder="Street#1234 USA"
                                             wire:model="user.address"/>
                                </div>

                                <div class="d-flex mt-2">
                                    <x-button class="btn btn-primary-lighter btn-lg rounded-pill px-5 fs-16 text-white fw-bold ms-auto"
                                              wire:click.prevent="onChangeProfile">
                                        <div wire:loading.remove wire:target="onChangeProfile">
                                            Update
                                        </div>
                                        <div wire:loading wire:target="onChangeProfile">
                                            Updating...
                                        </div>
                                    </x-button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="pb-3">
            <ul class="list-group list-group-vertical list-group-horizontal-lg setting-btn-group">

                <li class="list-group-item border-0 px-2 bg-transparent">
                    <a href="#" class="rounded-pill px-4 border p-2 fs-16 py-3 btn btn-lg btn-black-white-hover ">Add Admin Account</a>
                </li>

{{--                <li class="list-group-item border-0 px-2 bg-transparent">--}}
{{--                    <a href="#" class="rounded-pill px-4 border p-2 fs-16 py-3 btn btn-lg btn-dark ">add additional user--}}
{{--                        account</a>--}}
{{--                </li>--}}

{{--                <li class="list-group-item border-0 px-2 bg-transparent">--}}
{{--                    <a href="#" class="rounded-pill px-4 border p-2 fs-16 py-3 btn btn-lg btn-dark ">Add Administrator--}}
{{--                        settings</a>--}}
{{--                </li>--}}

{{--                <li class="list-group-item border-0 px-2 bg-transparent">--}}
{{--                    <a href="#" class="rounded-pill px-4 border p-2 fs-16 py-3 btn btn-lg btn-dark ">Manage--}}
{{--                        Administrator--}}
{{--                        user</a>--}}
{{--                </li>--}}

            </ul>
        </div>



            <div class="row my-5 mx-0 mx-lg-5 changeTeamPlan">
                <h3 class="text-center mb-4">Change User's Plan</h3>
                <div class="col-12 col-md-6 col-lg-3 mx-auto">
                    <div class="card bg-transparent text-center border-0 team-pricing-card mb-4" style="min-height: 340px;" >
                        <div class="card-body bg-white shadow rounded mb-4">
                            <h4 class="text-primary-light fw-bold mb-3">Free</h4>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="$0" class="w-75 fs-18" >
                                <p class="mb-0 ms-2 align-self-center w-25 fs-14 text-start" >/month</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="$0" class="w-75 fs-18" >
                                <p class="mb-0 ms-2 align-self-center w-25 fs-14 text-start" >/year</p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btnChangePlan rounded-pill fs-14 mx-3 text-uppercase btn btn-primary-light ">
                            Current plan <i class="fa fa-check fs-12 bg-white p-1 ms-2 rounded text-primary"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mx-auto">
                    <div class="card bg-transparent text-center border-0 team-pricing-card mb-4" style="min-height: 340px;" >
                        <div class="card-body bg-white shadow rounded mb-4">
                            <h4 class="text-primary-light fw-bold mb-3">Premium</h4>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="$10" class="w-75" >
                                <p class="mb-0 ms-2 align-self-center w-25 fs-14 text-start" >/month</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="$120" class="w-75" >
                                <p class="mb-0 ms-2 align-self-center w-25 fs-14 text-start" >/year</p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btnChangePlan rounded-pill fs-14 mx-3 text-uppercase btn btn-primary-light ">
                            Change plan
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mx-auto">
                    <div class="card bg-transparent text-center border-0 team-pricing-card mb-4" style="min-height: 340px;" >
                        <div class="card-body bg-white shadow rounded mb-4">
                            <h4 class="text-primary-light fw-bold mb-3">Team Free</h4>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="$0" class="w-75" >
                                <p class="mb-0 ms-2 align-self-center w-25 fs-14 text-start" >/month</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="$0" class="w-75" >
                                <p class="mb-0 ms-2 align-self-center w-25 fs-14 text-start" >/year</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="KW124" class="w-75 teamCode" >
                                <p class="mb-0 ms-2 align-self-center w-25 text-start fs-10 fw-500" >/Team Code</p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btnChangePlan rounded-pill fs-14 mx-3 text-uppercase btn btn-primary-light">
                            Change plan
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mx-auto">
                    <div class="card bg-transparent text-center border-0 team-pricing-card mb-4" style="min-height: 340px;" >
                        <div class="card-body bg-white shadow rounded mb-4">
                            <h4 class="text-primary-light fw-bold mb-3">Team Free</h4>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="$0" class="w-75" >
                                <p class="mb-0 ms-2 align-self-center w-25 fs-14 text-start" >/month</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="$0" class="w-75" >
                                <p class="mb-0 ms-2 align-self-center w-25 fs-14 text-start" >/year</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <input type="text" placeholder="KW124" class="w-75 teamCode" >
                                <p class="mb-0 ms-2 align-self-center w-25 text-start fs-10 fw-500" >/Team Code</p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btnChangePlan rounded-pill fs-14 mx-3 text-uppercase btn btn-primary-light ">
                            Change plan
                        </button>
                    </div>
                </div>
            </div>


        {{-- change password --}}
        @include('partials.profile.change-password')
    </div>
    @endhasanyrole
</div>
