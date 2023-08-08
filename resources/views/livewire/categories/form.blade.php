<div x-data @click.away="$wire.isEditing ? $wire.set('isEditing', false) : ''; $wire.creating ? $wire.set('creating', false) : ''">
    @if(!$isEditing && $category->id !== null)
        <div class="row">
            <div class="col-6 col-md-6">
                <div class="col-inner d-flex">
                    <div class="bg-white align-self-center w-38-h-38  rounded-circle">
                        @if($category->image)
                            <img class="rounded-circle w-25-h-25 primary-img" src="{{asset("storage/$category->image")}}" alt=""
                            />
                        @endif
                    </div>
                    <div class="mx-2 align-self-center">
                        <p class="text-white mb-0">{{ $category->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-2 col-md-3 d-flex align-self-center ">
                <div wire:sortable.handle style="cursor: move">
                    <img class="img-fluid" style="width: 25px"
                         src="{{asset('img/agent/categories/cat-grid.svg')}}"
                         alt="">
                </div>
            </div>
            <div class="col-4 col-md-3 text-end ">
                @if(($category->user_id !== null && auth()->user()->hasRole('agent')) || auth()->user()->hasRole(['admin', 'super-admin']))
                    <a href="#" wire:click.prevent="$set('isEditing', true)" class="me-2 me-md-4 text-decoration-none">
                        <img class="w-16" src="{{asset('img/dash/offer-forms/white-edit.svg')}}" alt="">
                    </a>
                    <a href="#" data-bs-toggle="modal"
                       data-bs-target="#deleteConfirmation{{ $category->id ?? 0 }}Modal" class="">
                        <img class="w-16" src="{{asset('img/menu-icons/cat-trash-icon.svg')}}" alt="">
                    </a>
                @endif
            </div>
        </div>
    @else
        @if(!$creating && $category->id === null)
            <div class="row">
                <div class="col-12">
                    <div class="col-inner d-flex">
                        <a href="#" wire:click.prevent="$set('creating', true)" class="bg-primary-light align-self-center agent-category-icon rounded-circle">
                            <i class="fa fa-plus addCatIcon text-white"></i>
                        </a>
                        <div class="mx-2 align-self-center">
                            <a href="#" wire:click.prevent="$set('creating', true)"
                               class="text-white mb-0 text-decoration-none">Click to add form category</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($isEditing || $creating)
            <div class="row">
                <div class="col-12 col-md-5 mb-3 mb-lg-0">
                    <div class="col-inner d-flex">
                        <div class="bg-white align-self-center agent-category-icon rounded-circle">
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('category_image_{{ $category->id ?? 0 }}').click()"
                               class="align-self-center  agent-category-icon rounded-circle"
                               style="width: 37px;"
                            >
                                @if($category->image)
                                    <img class="img-fluid p-3" width="33" src="{{asset("storage/$category->image")}}"
                                         alt="{{ $category->name }}">
                                @else
                                    <i class="fa fa-plus text-primary-light"></i>
                                @endif
                            </a>
                        </div>
                        <div class="mx-2 align-self-center w-100">
                            <x-input name="category.name" wire:model.lazy="category.name" class="py-1"/>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2 mb-3 mb-lg-0 align-self-center ">
                    @if($image)
                        <img src="{{ $image->temporaryUrl() }}" class="" width="40"/>
                    @endif

                    <div class="text-start"
                         x-data="{ isUploading{{ $category->id ?? 0 }}Image: false, progress{{ $category->id ?? 0 }}Image: 0 }"
                         x-on:livewire-upload-start="isUploading{{ $category->id ?? 0 }}Image = true"
                         x-on:livewire-upload-finish="isUploading{{ $category->id ?? 0 }}Image = false;"
                         x-on:livewire-upload-error="isUploading{{ $category->id ?? 0 }}Image = false"
                         x-on:livewire-upload-progress="progress{{ $category->id ?? 0 }}Image = $event.detail.progress"
                    >
                        <x-input type="file" name="image" wire:model="image" class="d-none"
                                 id="category_image_{{ $category->id ?? 0 }}"/>
                        <div class="progress mt-2" x-show="isUploading{{ $category->id ?? 0 }}Image" style="height: 15px">
                            <div class="progress-bar" role="progressbar"
                                 :style="`width: ${progress{{ $category->id ?? 0 }}Image}%`"
                                 x-on:aria-valuenow="progress{{ $category->id ?? 0 }}Image" aria-valuemin="0"
                                 aria-valuemax="100"
                                 x-text="`${progress{{ $category->id ?? 0 }}Image}%`">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-5 mb-3 mb-lg-0 text-end ">
                    <x-button class=" btn-primary px-5 py-2 text-uppercase shadow-sm"
                              wire:click.prevent="save">
                        <div wire:loading.remove wire:target="save">
                            Save
                        </div>
                        <div wire:loading wire:target="save">
                            Saving...
                        </div>
                    </x-button>
                </div>
            </div>
        @endif
    @endif
</div>
