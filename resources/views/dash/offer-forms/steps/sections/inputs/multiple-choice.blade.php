@push('stylesheets')
    <style>
        .radioButton:checked[type=radio] {
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjMiIGhlaWdodD0iNTkiIHZpZXdCb3g9IjAgMCA2MyA1OSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGVsbGlwc2UgY3g9IjMxLjA1MjgiIGN5PSIyOS4zODczIiByeD0iMzEuMDUyOCIgcnk9IjI5LjM4NzMiIGZpbGw9IiM5QzRFREQiLz4KPC9zdmc+Cg==) !important;
        }

        .radioButton:checked {
            background-color: #9C4EDD;
            border-color: #9C4EDD;
        }

        @media (max-width: 576px) {
            .radioButton {
                width: 24px !important;
                height: 24px !important;
            }
        }
    </style>
@endpush

@if($routeIsEdit)
    <div class="text-start mt-4" wire:sortable="changeSectionInputOptionsSortOrder" wire:key="{{ $stepSection->id . time() }}">
        @empty($subTypeOptions)
            <div class="row mb-3">
                <div class="col-2 pt-2 text-end">
                    <img class="xmm-small-icon" style="margin-left: 0px"
                         src="{{asset('img/form-builder/icons/grid.svg')}}" alt="">
                    <input class="form-check-input ms-2" type="radio" name="checkbox" id="checkbox" style="height: 20px;width: 20px">
                </div>
                <div class="col-8 border-bottom form-group">
                    <x-input wire:model.lazy="subTypeOptions.0.text" class="border-0 rounded-0 form-control text-start ph-start outline-none input-data-text-primary-light"
                             wire:change.debounce.100ms="onChangeInputs"
                             wire:loading.attr="disabled"
                             wire:target="onChangeInputs"
                             id=""
                             placeholder="Click me to change text"
                    />
                    <label for="" class="animated-label"></label>
                </div>
                <div class="col-2 pt-2 d-flex">
                    <input type="file" wire:change="onChangeSectionOptionImage(0)" wire:model="stepSectionOptionImage"
                           id="inputs-multiple-choices-{{$stepSection->id}}0" class=" px-0 d-none "/>
                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('inputs-multiple-choices-{{$stepSection->id}}0').click();"
                       class="text-decoration-none mx-2 pt-1">
                        <img class="xm-small-icon" src="{{asset('img/form-builder/icons/thumbnail.svg')}}" alt=""/>
                    </a>
                </div>
            </div>
        @else
            @foreach($subTypeOptions as $key => $option)
                <div class="row mb-3" wire:sortable.item="{{ $loop->index }}">
                    <div class="col-2 pt-2 text-end">
                        <img class="xmm-small-icon" style="margin-left: 0; cursor: pointer;"
                             src="{{asset('img/form-builder/icons/grid.svg')}}" alt="" wire:sortable.handle />
                        <input class="form-check-input ms-2" type="radio" name="checkbox" id="checkbox" style="height: 20px;width: 20px">
                    </div>
                    <div class="col-7 col-md-8 border-bottom form-group">

                        <x-input wire:model.lazy="subTypeOptions.{{$loop->index}}.text"
                                 class="border-0 px-0 rounded-0 fs-18 fs-18-sm form-control outline-none ph-start input-data-text-primary-light"
                                 wire:change.debounce.500ms="onChangeInputs()" style="color: #D5B6ED" placeholder="Click me to change text"/>
                        <label for="" class="animated-label"></label>

                        <div
                            x-data="{ isUploading{{ $stepSection->id }}{{$loop->index}}OptionImage: false, progress{{ $stepSection->id }}{{$loop->index}}OptionImage: 0 }"
                            x-on:livewire-upload-start="isUploading{{ $stepSection->id }}{{$loop->index}}OptionImage = true"
                            x-on:livewire-upload-finish="isUploading{{ $stepSection->id }}{{$loop->index}}OptionImage = false; @this.onChangeSectionOptionImage({{$loop->index}})"
                            x-on:livewire-upload-error="isUploading{{ $stepSection->id }}{{$loop->index}}OptionImage = false"
                            x-on:livewire-upload-progress="progress{{ $stepSection->id }}{{$loop->index}}OptionImage = $event.detail.progress"
                        >
                            <input type="file"
                                   wire:model="stepSectionOptionImage"
                                   id="inputs-multiple-choices-{{$stepSection->id}}{{$loop->index}}" class="d-none"/>
                            <div class="progress mt-2" x-show="isUploading{{ $stepSection->id }}{{$loop->index}}OptionImage"
                                 style="height: 15px">
                                <div class="progress-bar" role="progressbar"
                                     :style="`width: ${progress{{ $stepSection->id }}{{$loop->index}}OptionImage}%`"
                                     x-on:aria-valuenow="progress{{ $stepSection->id }}{{$loop->index}}OptionImage"
                                     aria-valuemin="0" aria-valuemax="100"
                                     x-text="`${progress{{ $stepSection->id }}{{$loop->index}}OptionImage}%`"></div>
                            </div>
                        </div>
                        @isset($option['image'])
                            <div class="position-relative mt-3" style="max-height: 200px; max-width: 200px">
                                <a href="#" wire:click.prevent="onChangeSectionOptionImage({{$loop->index}}, 'remove')"
                                   class="position-absolute top-0 start-100 translate-middle btn btn-light shadow rounded-circle text-decoration-none">&times;</a>
                                <img src="{{ asset("storage/{$option['image']}") }}" class="img-thumbnail"/>
                            </div>
                        @endisset
                    </div>
                    <div class="col-2 pt-2 d-flex">
                        <a href="#"
                           onclick="event.preventDefault(); document.getElementById('inputs-multiple-choices-{{$stepSection->id}}{{$loop->index}}').click();"
                           class="text-decoration-none mx-2 pt-1">
                            <img class="xm-small-icon" src="{{asset('img/form-builder/icons/thumbnail.svg')}}" alt=""/>
                        </a>
                        <a href="#" wire:click.prevent="pushOrPopNewOptionToSubTypeOptions('pop', {{$loop->index}})"
                           class="text-decoration-none fs-22">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @endempty
        <div class="row">
            <div class="offset-2 col-8 border-bottom pb-2 ps-0">
                <a href="javascript:void(0)" wire:click.prevent="pushOrPopNewOptionToSubTypeOptions()"
                   class="text-decoration-none addMoreMultipleCheckBoxInput fs-18 fs-18-sm mb-3" style="color: #D5B6ED">
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
        x-data="{multipleChoice{{ $stepSection->id }}: '{{  $this->defaultOrValue }}'}"
        class="text-start w-full-md-75 mt-3">
        @foreach($subTypeOptions as $key => $option)
            <div class="form-check mb-3">
                <input
                    class="form-check-input radioButton" style="width: 26px; height: 26px"
                    type="radio"
                    name="multiple_choice_{{ $stepSection->id }}"
                    id="multiple_choice_{{ $stepSection->id }}{{ $loop->index }}"
                    x-on:change="$wire.onFormInputChange('multiple_choice', $el.value)"
                    x-model="multipleChoice{{ $stepSection->id }}"
                    value="{{ $loop->index }}"
                >
                <label class="form-check-label ms-3 mt-1 fw-bold"
                       for="multiple_choice_{{ $stepSection->id }}{{ $loop->index }}">
                    {{ $option['text'] ?? ''}}
                </label>
                @isset($option['image'])
                    <img src="{{ asset("storage/{$option['image']}") }}" class="img-thumbnail"/>
                @endisset
            </div>
        @endforeach
    </div>
@endif
