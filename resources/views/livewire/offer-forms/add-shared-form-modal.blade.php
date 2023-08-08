<div class="modal fade hideableModal" id="addSharedFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true"
     wire:ignore.self
>
    <div class="modal-dialog modal-xl position-relative">
        <div class="modal-content rounded-3 px-3">
            <div class="modal-header border-0 text-center">
                <button type="button" class="btn-modal btn-primary-light-black-hover rounded-circle fs-12"
                        data-bs-dismiss="modal" aria-label="Close">X
                </button>
            </div>
            <div class="modal-body mt-3">
                <div class="row mb-4">
                    <div
                        @class([
                            'col-12',
                            'col-lg-6' => !auth()->user()->hasRole('agent'),
                            'col-lg-9' => auth()->user()->hasRole('agent'),
                            'mb-2',
                        ])
                    >
                        <div class="input-group form-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                            <div class="input-group-prepend border-0 align-self-center">
                                <button id="button-addon4" type="button"
                                        class="btn btn-link text-dark rounded-circle">
                                    <div wire:target="search" wire:loading>
                                        <x-spinner class="me-2"/>
                                    </div>
                                    <img class="w-17" src="{{asset('img/menu-icons/search-icon.svg')}}" alt="" wire:loading.remove
                                         wire:target="search">
                                </button>
                            </div>
                            <input
                                class="form-control form-control-lg form-control form-control-lg rounded-pill bg-none border-0 search"
                                type="text" placeholder="Search by OfferForm Name or Author"
                                aria-describedby="button-addon4" wire:model.debounce.500ms="search">

                        </div>
                    </div>
                    <div
                        @class([
                            'col-12',
                            'col-lg-6' => !auth()->user()->hasRole('agent'),
                            'col-lg-3' => auth()->user()->hasRole('agent'),
                            'mb-2',
                            'd-flex' => !auth()->user()->hasRole('agent'),
                            'd-grid' => auth()->user()->hasRole('agent')
                        ])
                    >
                        <button
                           class="btn btn-lg rounded-pill btn-primary-light text-white shadow-sm text-uppercase"
                           wire:click.prevent="addForm" wire:loading.attr="disabled" {{ count($selectedForms) === 0 ? 'disabled' : '' }}>
                            <div wire:target="addForm" wire:loading>
                                <x-spinner class="me-2"/>
                            </div>
                            <img
                                src="{{asset('img/menu-icons/plus-white-icon.svg')}}"
                                alt=""
                                class="w-18 me-3"
                                wire:target="addForm" wire:loading.remove
                            /> Add Form
                        </button>
                        @unlessrole('agent')
                            <button
                                class="btn btn-lg rounded-pill btn-primary-light text-white shadow-sm text-uppercase mx-2"
                                wire:click.prevent="editForms" wire:loading.attr="disabled" {{ count($selectedForms) === 0 ? 'disabled' : '' }}>
                                <div wire:target="editForms" wire:loading>
                                    <x-spinner class="me-2"/>
                                </div>
                                <img
                                    src="{{asset('img/menu-icons/admin-icon/edit-icon.svg')}}"
                                    alt=""
                                    class="w-16 me-3"
                                    wire:target="editForms" wire:loading.remove
                                /> Edit Form
                            </button>
                            <button
                                class="btn btn-lg rounded-pill btn-primary-light text-white shadow-sm text-uppercase"
                                wire:click.prevent="destroy" wire:loading.attr="disabled" {{ count($selectedForms) === 0 ? 'disabled' : '' }}>
                                <div wire:target="destroy" wire:loading>
                                    <x-spinner class="me-2"/>
                                </div>
                                <img
                                    src="{{asset('img/menu-icons/admin-icon/delete.svg')}}"
                                    alt=""
                                    class="w-16 me-3"
                                    wire:target="destroy" wire:loading.remove
                                /> Delete Form
                            </button>
                        @endunlessrole
                    </div>
                </div>

                <div class="mt-5">
                    <div class="card border-0 hover-border mb-3 bg-primary d-none d-lg-block">
                        <div class="card-body row text-center text-white">
                            <div class="col-12 col-lg-1 fw-500">Select</div>
                            <div class="col-12 col-lg-3 fw-500">Form Name</div>
                            <div class="col-12 col-lg-3 fw-500">Form Description</div>
                            <div class="col-12 col-lg-2 fw-500">Author</div>
                            <div class="col-12 col-lg-2 fw-500">Date Shared</div>
                            <div class="col-12 col-lg-1 fw-500">Preview</div>
                        </div>
                    </div>
                </div>
                @foreach($offerForms as $offerForm)
                    <div>
                        <div class="card border-0 hover-border mb-3 py-3 shadow-sm">
                            <div class="card-body row text-center">
                                <div class="col-12 col-lg-1 mb-3 mb-lg-0 align-self-center fw-bold">
                                    <div class="form-group text-center">
                                        <div class="form-check">
                                            <input class="form-check-input mx-auto mt0-5" type="checkbox"
                                                   id="selectedForms{{ $offerForm->id }}"
                                                   style="width: 22px;height: 22px"
                                                   wire:model="selectedForms"
                                                   value="{{ $offerForm->id }}"
                                            >
                                            <label class="form-check-label"
                                                   for="libraryStep">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mb-3 mb-lg-0 align-self-center">
                                    <h6 class="fw-500">{{ $offerForm->name }}</h6>
                                </div>
                                <div class="col-12 col-lg-3 mb-3 mb-lg-0 align-self-center">
                                    <h6 class="fw-500">{{ $offerForm->decription }}</h6>
                                </div>
                                <div class="col-12 col-lg-2 mb-3 mb-lg-0 align-self-center">
                                    <h6 class="fw-500 text-primary-light">{{ $offerForm->createdBy->full_name }}</h6>
                                </div>
                                <div class="col-12 col-lg-2 mb-3 mb-lg-0 align-self-center">
                                    <h6 class="fw-500">{{ str_replace('00:00:00', '', $offerForm->universally_shared_at) }}</h6>
                                </div>
                                <div class="col-12 col-lg-1  mb-lg-0 text-primary fw-bold align-self-center">
                                    <a href="{{ $offerForm->getViewFormLink(true, route('dash.offer-forms.index')) }}">
                                        <img src="{{asset('img/menu-icons/primary-eye-icon.svg')}}" class="w-28 mt0-5"
                                             alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <x-modals.delete-confirmation :id="'shredformdelete'" :action='"destroy()"'
                                  :key="time().'shredformdelete'">

        <x-slot name="title">
            Are you sure you want to delete this form from shared space?
        </x-slot>

        <x-slot name="description">
            You would not be able to recover this!
        </x-slot>

    </x-modals.delete-confirmation>
</div>
