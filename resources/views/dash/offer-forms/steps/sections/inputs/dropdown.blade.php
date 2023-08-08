@push('stylesheets')
    <style>
        select {
            max-height: calc(1.2em + 24px);
            height: calc(1.2em + 24px);
        }

        option:hover{
            color: #9C4EDD !important;
        }

    </style>
@endpush

@if($routeIsEdit)
    <div class="text-start mb-3" wire:sortable="changeSectionInputOptionsSortOrder"  wire:key="{{ $stepSection->id . time() }}">
        @empty($subTypeOptions)
            <div class="row mb-3">
                <div class="col-2 pt-2 text-end">
                    <img class="xm-small-icon"
                         src="{{asset('img/form-builder/icons/grid.svg')}}" alt="">
                    <span class="fs-18">1.</span>
                </div>
                <div class="col-8">
                    <x-input wire:model.lazy="subTypeOptions.0.text" class="border-0 border-bottom rounded-0 outline-none ph-start input-data-text-primary-light"
                             placeholder="Click me to change text"
                             wire:change.debounce.500ms="onChangeInputs()"/>
                </div>
                <div class="col-2 pt-2 d-flex">
                    {{--                    <input type="file" wire:change="onChangeSectionOptionImage({{$key}})" wire:model="stepSectionOptionImage" id="inputs-dropdown-{{$stepSection->id}}{{$key}}" class="d-none"/>--}}
                    {{--                    <a href="#" onclick="event.preventDefault(); document.getElementById('inputs-dropdown-{{$stepSection->id}}{{$key}}').click();">Add Image</a>--}}

                </div>
            </div>
        @else
            @foreach($subTypeOptions as $key => $option)
                <div class="row mb-3" wire:sortable.item="{{ $loop->index }}">
                    <div class="col-2 pt-2 text-end">
                        <img class="xm-small-icon"
                             style="cursor:pointer;"
                             src="{{asset('img/form-builder/icons/grid.svg')}}" alt="" wire:sortable.handle/>
                        <span class="fs-18">{{ $loop->iteration }}.</span>
                    </div>
                    <div class="col-8">
                        <x-input wire:model.lazy="subTypeOptions.{{$key}}.text" class="border-0 border-bottom rounded-0 outline-none ph-start input-data-text-primary-light"
                                 wire:change.debounce.100ms="onChangeInputs"
                                 wire:loading.attr="disabled"
                                 placeholder="Click me to change text"
                                 wire:target="onChangeInputs"
                        />
    {{--                    @isset($option['image'])--}}
    {{--                        <div class="position-relative mt-3" style="max-height: 300px; max-width: 300px">--}}
    {{--                            <a href="#" wire:click.prevent="onChangeSectionOptionImage({{$key}}, 'remove')">Remove Image</a>--}}
    {{--                            <img src="{{ asset("storage/{$option['image']}") }}" class="img-thumbnail"/>--}}
    {{--                        </div>--}}
    {{--                    @endisset--}}
                    </div>
                    <div class="col-2 pt-2 d-flex">
    {{--                    <input type="file" wire:change="onChangeSectionOptionImage({{$key}})" wire:model="stepSectionOptionImage" id="inputs-dropdown-{{$stepSection->id}}{{$key}}" class="d-none"/>--}}
    {{--                    <a href="#" onclick="event.preventDefault(); document.getElementById('inputs-dropdown-{{$stepSection->id}}{{$key}}').click();">Add Image</a>--}}
                        <a href="#" wire:click.prevent="pushOrPopNewOptionToSubTypeOptions('pop', {{$key}})" class="text-decoration-none fs-22">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @endempty
        <div class="row">
            <div class="offset-2 col-8 border-bottom pb-2">
                <a href="javascript:void(0)" wire:click.prevent="pushOrPopNewOptionToSubTypeOptions()" class="text-decoration-none addMoreMultipleCheckBoxInput text-primary-light fs-18 mb-3">
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
    <div class="mt-4 w-full-md-75">
        <x-select
            wire:ignore
            class="form-select form-control form-control-lg text-center text-white bg-primary-light fw-400 rounded-3 fs-20 select-arrow-down"
            x-on:change="$wire.onFormInputChange('dropdown', $el.value)"
            x-init="$el.value = '{{ $this->defaultOrValue }}'"
        >
            <option class="text-white" selected="selected" value="">Click to select an option</option>
            @foreach($subTypeOptions as $key => $option)
                <option class="bg-white text-dark" value="{{$key}}">{{$option['text'] ?? '' }}</option>
            @endforeach
        </x-select>
    </div>
@endif
