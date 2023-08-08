@push('stylesheets')
    <style>
        /*.form-check-input:checked[type=radio] {*/
        /*    background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjMiIGhlaWdodD0iNTkiIHZpZXdCb3g9IjAgMCA2MyA1OSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGVsbGlwc2UgY3g9IjMxLjA1MjgiIGN5PSIyOS4zODczIiByeD0iMzEuMDUyOCIgcnk9IjI5LjM4NzMiIGZpbGw9IiM5QzRFREQiLz4KPC9zdmc+Cg==) !important;*/
        /*}*/

        .checkBoxes:checked {
            background-color: #9C4EDD;
            border-color: #9C4EDD;
        }

        .checkBoxes {
            width: 24px !important;
            height: 24px !important;
        }

        /*@media (max-width: 576px) {*/
        /*    .checkBoxes {*/
        /*        width: 24px !important;*/
        /*        height: 24px !important;*/
        /*    }*/
        /*}*/
    </style>
@endpush



@if($routeIsEdit)
    <div class="text-start mt-4" wire:sortable="changeSectionInputOptionsSortOrder" wire:key="{{ $stepSection->id . time() }}">
        @empty($subTypeOptions)
            <div class="row mb-3">
                <div class="col-2 pt-2 text-end">
                    <img class="xmm-small-icon me-2" style="margin-left: 0px"
                         src="{{asset('img/form-builder/icons/grid.svg')}}" alt="">
                    <input class="form-check-input" style="margin-top: 6px;" type="checkbox" name="checkbox" id="checkbox">

                </div>
                <div class="col-8 form-group border-bottom ">
                    <x-input wire:model.lazy="subTypeOptions.0.text" class="border-0 rounded-0 form-control ph-start outline-none input-data-text-primary-light"
                             wire:change.debounce.500ms="onChangeInputs()"
                             placeholder="Click me to change text"
                    />
                    <label for="" class="animated-label"></label>

                    <div
                        x-data="{ isUploading{{ $stepSection->id }}0OptionImage: false, progress{{ $stepSection->id }}0OptionImage: 0 }"
                        x-on:livewire-upload-start="isUploading{{ $stepSection->id }}0OptionImage = true"
                        x-on:livewire-upload-finish="isUploading{{ $stepSection->id }}0OptionImage = false; @this.onChangeSectionOptionImage(0)"
                        x-on:livewire-upload-error="isUploading{{ $stepSection->id }}0OptionImage = false"
                        x-on:livewire-upload-progress="progress{{ $stepSection->id }}0OptionImage = $event.detail.progress"
                    >
                        <input type="file" wire:model="stepSectionOptionImage"
                               id="inputs-checkboxes-{{$stepSection->id}}0" class="d-none"/>
                        <div class="progress mt-2" x-show="isUploading{{ $stepSection->id }}0OptionImage"
                             style="height: 15px">
                            <div class="progress-bar" role="progressbar"
                                 :style="`width: ${progress{{ $stepSection->id }}0OptionImage}%`"
                                 x-on:aria-valuenow="progress{{ $stepSection->id }}0OptionImage"
                                 aria-valuemin="0" aria-valuemax="100"
                                 x-text="`${progress{{ $stepSection->id }}0OptionImage}%`"></div>
                        </div>
                    </div>
                </div>
                <div class="col-2 pt-2 d-flex">
                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('inputs-checkboxes-{{$stepSection->id}}0').click();"
                       class="text-decoration-none mx-2 pt-1">
                        <img class="xm-small-icon me-2" src="{{asset('img/form-builder/icons/thumbnail.svg')}}" alt=""/>
                    </a>
                </div>
            </div>
        @else
            @foreach($subTypeOptions as $key => $option)
                <div class="row mb-3" wire:sortable.item="{{ $loop->index }}">
                    <div class="col-2 pt-2 text-end">
                        <img class="xmm-small-icon me-2" style="margin-left: 0px"
                             src="{{asset('img/form-builder/icons/grid.svg')}}" alt=""  wire:sortable.handle />
                        <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox" style="margin-top: 6px">
                    </div>
                    <div class="col-8 form-group">
                        <x-input
                            wire:model.lazy="subTypeOptions.{{$key}}.text" class="border-0 border-bottom fs-18 rounded-0 form-control outline-none ph-start input-data-text-primary-light"
                            wire:change.debounce.100ms="onChangeInputs"
                            wire:loading.attr="disabled"
                            wire:target="onChangeInputs"
                            placeholder="Click me to change text"
                        />
                        <label for="" class="animated-label"></label>
                        <div
                            x-data="{ isUploading{{ $stepSection->id }}{{$key}}OptionImage: false, progress{{ $stepSection->id }}{{$key}}OptionImage: 0 }"
                            x-on:livewire-upload-start="isUploading{{ $stepSection->id }}{{$key}}OptionImage = true"
                            x-on:livewire-upload-finish="isUploading{{ $stepSection->id }}{{$key}}OptionImage = false; @this.onChangeSectionOptionImage({{$key}})"
                            x-on:livewire-upload-error="isUploading{{ $stepSection->id }}{{$key}}OptionImage = false"
                            x-on:livewire-upload-progress="progress{{ $stepSection->id }}{{$key}}OptionImage = $event.detail.progress"
                        >
                            <input type="file"
                                   wire:model="stepSectionOptionImage" id="inputs-checkboxes-{{$stepSection->id}}{{$key}}"
                                   class="d-none"/>
                            <div class="progress mt-2" x-show="isUploading{{ $stepSection->id }}{{$key}}OptionImage"
                                 style="height: 15px">
                                <div class="progress-bar" role="progressbar"
                                     :style="`width: ${progress{{ $stepSection->id }}{{$key}}OptionImage}%`"
                                     x-on:aria-valuenow="progress{{ $stepSection->id }}{{$key}}OptionImage"
                                     aria-valuemin="0" aria-valuemax="100"
                                     x-text="`${progress{{ $stepSection->id }}{{$key}}OptionImage}%`"></div>
                            </div>
                        </div>
                        @isset($option['image'])
                            <div class="position-relative mt-3" style="max-height: 300px; max-width: 300px">
                                <a href="#" wire:click.prevent="onChangeSectionOptionImage({{$key}}, 'remove')"
                                   class="position-absolute top-0 start-100 translate-middle btn btn-light shadow rounded-circle text-decoration-none">&times;</a>
                                <img src="{{ asset("storage/{$option['image']}") }}" class="img-thumbnail" alt=""/>
                            </div>
                        @endisset
                    </div>
                    <div class="col-2 pt-2 d-flex">
                        <a href="#"
                           onclick="event.preventDefault(); document.getElementById('inputs-checkboxes-{{$stepSection->id}}{{$key}}').click();"
                           class="text-decoration-none mx-2 pt-1">
                            <img class="xm-small-icon" src="{{asset('img/form-builder/icons/thumbnail.svg')}}" alt=""/>
                        </a>
                        <a href="#" wire:click.prevent="pushOrPopNewOptionToSubTypeOptions('pop', {{$key}})"
                           class="text-decoration-none fs-22">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @endempty
        <div class="row">
            <div class="offset-2 col-8 border-bottom pb-2">
                <a href="javascript:void(0)" wire:click.prevent="pushOrPopNewOptionToSubTypeOptions"
                   class="text-decoration-none addMoreMultipleCheckBoxInput text-primary-light fs-18 mb-3">
                    <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>
                    <span wire:loading.remove wire:target="pushOrPopNewOptionToSubTypeOptions">
                        Click me to add new option
                    </span>
                    <span wire:loading wire:target="pushOrPopNewOptionToSubTypeOptions">
                        Please wait....
                    </span>
                </a>
            </div>
        </div>
    </div>
@else
    <div
        x-data="{checkboxes{{ $stepSection->id }}: '{{ $this->defaultOrValue  }}'.split(',') }"
        class="text-start  w-full-md-75 mt-4">
        @foreach($subTypeOptions as $key => $option)
            <div class="form-check mb-3">
                <input
                    class="form-check-input checkBoxes"
                    type="checkbox"
                    id="multiple_choice_{{ $stepSection->id }}{{ $key }}"
                    x-on:change="$wire.onFormInputChange('checkboxes', checkboxes{{ $stepSection->id }}.join(','))"
                    x-model="checkboxes{{ $stepSection->id }}"
                    value="{{ $key }}"
                >
                <label class="form-check-label ms-3 mt-1 fw-bold " for="multiple_choice_{{ $stepSection->id }}{{ $key }}">
                   {{ $option['text'] ?? '' }}
                </label>
            </div>
        @endforeach
    </div>
@endif
