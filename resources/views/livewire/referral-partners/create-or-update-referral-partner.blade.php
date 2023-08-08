<div>

    <div class="container my-3 ">
        <div class="d-gird gap-4 mb-3">
            <a href="{{route('dash.referral-partners.referral-partners-by-type',$referralPartnerType->slug)}}" class="btn btn-lg w-150 btn-white-black-hover btn-hover-white-img me-2
            fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill" type="button">
                <i class="fa fa-angle-left fs-20 me-3"></i>Back
            </a>

            @if($isEdit && $referralPartner->leads->count() == 0 && $referralPartner->offers->count() == 0)
                <a href=""
                   data-bs-toggle="modal"
                   data-bs-target="#deleteConfirmation{{ $referralPartnerType->id ?? 0 }}Modal"
                   class="btn btn-lg w-150 btn-white-black-hover mb-2 btn-hover-white-img fw-500 shadow-sm me-2 my-2 my-lg-0 fs-14 rounded-pill text-uppercase">
                    <img class="w-22 pe-2" src="{{asset('img/menu-icons/red-trash.svg')}}" alt="">Delete
                </a>
            @endif
        </div>
        <x-modals.delete-confirmation :id="$referralPartnerType->id" :action='"delete($referralPartnerType->id)"'
                                      :key="time().$referralPartnerType->id"></x-modals.delete-confirmation>

        <div class="container my-4" x-data="">
            <div class="card border-0 mb-4 shadow-sm p-3">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <h5 class="fw-bold text-primary-light text-capitalize"> {{$referralPartnerType->name}}</h5>
                        </div>
                        <div class="col-12 col-md-6">
                            <h5 class="fw-bold">Referral Partner Contact Info</h5>
                        </div>
                    </div>

                    <form wire:submit.prevent="createOrUpdate">
                        <div class="row my-3">
                            <div class="col-12 col-lg-4">
                                <div x-data="{photoName: null, photoPreview: null}">
                                    <div class="mb-3">
                                        <!-- Current Profile Photo -->
                                        <div class="mt-2" x-show="!photoPreview">
                                            @if($referralPartner)
                                                <img
                                                    src="{{ $referralPartner->image_url }}"
                                                    alt="{{ $referralPartner->first_name }}"
                                                    class="w-100 rounded-3"
                                                    style="min-height: 250px;object-fit: cover"
                                                />
                                            @else
                                                <img
                                                    src="/img/dash/dummy-img.jpg"
                                                    alt="Upload"
                                                    class="w-100 rounded-3"
                                                    style="min-height: 250px;object-fit: cover"
                                                />
                                            @endif
                                        </div>

                                        <!-- New Profile Photo Preview -->
                                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                                            <img
                                                :src="photoPreview"
                                                alt="Upload"
                                                class="w-100 rounded-3"
                                                style="min-height: 250px;object-fit: cover"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <label for="photo" class="file-upload-label change-img">
                                            @role('admin')
                                            <img class="w-18 me-3"
                                                 src="{{asset('img/menu-icons/upload-icon.svg')}}"
                                                 alt=""
                                            />
                                            @endrole
                                            Select Image
                                        </label>
                                        <div class="text-start mt-2"
                                             x-data="{ isUploadingImage: false, progressImage: 0 }"
                                             x-on:livewire-upload-start="isUploadingImage = true"
                                             x-on:livewire-upload-finish="isUploadingImage = false;"
                                             x-on:livewire-upload-error="isUploadingImage = false"
                                             x-on:livewire-upload-progress="progressImage = $event.detail.progress"
                                        >

                                            <!-- Profile Photo File Input -->
                                            <input type="file" id="photo" class="d-none"
                                                   wire:model="image"
                                                   x-ref="photo"
                                                   x-on:change="
                                                    photoName = $refs.photo.files[0].name;
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => {
                                                        photoPreview = e.target.result;
                                                    };
                                                    reader.readAsDataURL($refs.photo.files[0]);
                                               "/>

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

                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="form-group col-12 mb-3">
                                        <label class="fw-bold mb-2" for="">Company Name</label>
                                        <x-input type="text" name="company_name" wire:model.defer="state.company_name"
                                                 class="py-3"/>
                                    </div>

                                    <div class="form-group col-12 col-lg-6 mb-3">
                                        <label class="fw-bold mb-2" for="">First Name</label>
                                        <x-input type="text" name="first_name" wire:model.defer="state.first_name"
                                                 class="py-3"/>
                                    </div>

                                    <div class="form-group col-12 col-lg-6 mb-3">
                                        <label class="fw-bold mb-2" for="">Last Name</label>
                                        <x-input type="text" name="last_name" wire:model.defer="state.last_name"
                                                 class="py-3"/>
                                    </div>


                                    <div class="form-group col-12 col-lg-6 mb-3">
                                        <label class="fw-bold mb-2" for="">Email Address</label>
                                        <x-input type="text" name="email" wire:model.defer="state.email" class="py-3"/>
                                    </div>

                                    <div class="form-group col-12 col-lg-6 mb-3">
                                        <label class="fw-bold mb-2" for="">Phone Number</label>
                                        <x-input type="text" name="phone" wire:model.defer="state.phone" class="py-3" x-mask="{numericOnly: true, blocks: [0, 3, 3, 4], delimiters: ['(', ') ', '-']}"/>
                                    </div>

                                    <div class="form-group col-12 col-lg-4 mb-3">
                                        <label class="fw-bold mb-2" for="">Date of First Service</label>
                                        <x-input type="date" name="date_of_first_service"
                                                 wire:model.defer="state.date_of_first_service" class="py-3"/>
                                    </div>

                                    <div class="form-group col-12 col-lg-8 mb-3">
                                        <label class="fw-bold mb-2" for=""> Address</label>
                                        <x-input type="text" name="address" wire:model.defer="state.address"
                                                 class="py-3"/>
                                    </div>

                                    <div class="form-group col-12 col-lg-12 mb-3">
                                        <label class="fw-bold mb-2" for=""> Notes</label>
                                        <x-textarea type="text" name="notes" wire:model.defer="state.notes"
                                                    class="py-3"/>
                                    </div>

                                    <div class="form-group mt-2 text-end">
                                        <x-button type="submit"
                                                  class="btn-primary-light px-5 rounded-3 py-2 text-uppercase shadow-sm">
                                            @if(!$isEdit)
                                                Save
                                            @else
                                                Update
                                            @endif
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if($referralPartner)
                <livewire:referral-partners.partials.integrations-setting-form :referral-partner="$referralPartner"/>
                <livewire:referral-partners.partials.service-areas-setting-form :referral-partner="$referralPartner"/>

                {{-- Edit Referral Partner Screen--}}
                <div class="card border-0 mb-4 shadow-sm p-3">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-center mb-4">Edit Referral Partner Screen</h5>
                        <div class="btn-group mt-4" role="group" aria-label="Basic example">
                            <a href="{{ $referralPartner->step_edit_url }}"
                               class="btn btn-primary-light mx-3 rounded-3 w-210 btn-sm-100 mb-3 mb-lg-0">
                                <img src="{{asset('img/dash/offer-forms/white-edit.svg')}}" class="w-15 me-2" alt="">Edit
                                Screen
                            </a>
                            <a href="{{ $referralPartner->step_preview_url }}"
                               class="btn btn-primary-light mx-3 rounded-3 w-210 btn-sm-100 mb-3 mb-lg-0">
                                <img src="{{asset('img/menu-icons/eye-icon.svg')}}" class="w-16 me-2" alt="">Preview
                                Screen
                            </a>
                        </div>
                    </div>
                </div>


                <livewire:referral-partners.partials.bill-per-lead-or-month-setting-form
                    :referral-partner="$referralPartner"/>
                <livewire:referral-partners.partials.payment-method-setting-form :referral-partner="$referralPartner"/>
            @endif
        </div>
    </div>
</div>

