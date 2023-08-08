@push('stylesheets')


@endpush

@if($routeIsEdit)
    <div wire:sortable="changeSectionLogicSortOrder" class="text-start w-full-md-75 logic-input" x-data>
        @empty($logics)
            <div class="row mb-3">
                <div class="col-2 pt-2 text-end">
                    <img class="xm-small-icon"
                         src="{{asset('img/form-builder/icons/grid.svg')}}" alt="">
                    <span class="fs-18">1.</span>
                </div>
                <div class="col-8">
                    <x-input wire:model.lazy="logics.0.name" class="border-0 border-bottom rounded-0 outline-none"
                             wire:change.debounce.500ms="onChangeLogic"/>
                </div>
                <div class="col-2 pt-2 d-flex">
                </div>
            </div>

{{--            select-logic-option offer-form-select--}}
        @else
            @php
                $sectionsToLinkWithLogic = \App\Models\OfferForms\OfferFormSection::where('offer_form_id', $stepSection->offer_form_id)->orderBy('display_order')->get();
            @endphp
            @foreach($logics as $logic)
                @php
                    $hasLinkedSections = $logic->linkedSections->count() > 0;
                    $iteration = 1;
                @endphp
                <div class="row mb-3"  wire:sortable.item="{{ $logic->id }}" x-data="{toggleDropDown: false}">
                    <div class="col-12 col-lg-2 mb-3 mb-lg-0 pt-2 text-start text-lg-end d-flex justify-content-between d-lg-block">
                        <img class="xm-small-icon"
                             src="{{asset('img/form-builder/icons/grid.svg')}}" alt="" wire:sortable.handle style="cursor: move">
                        <span class="fs-18 me-2 me-lg-0">
                            <img src="{{asset('img/menu-icons/primary-pencil.svg')}}" class="w-15 ms-2" alt="">
{{--                            {{ $loop->iteration }}.--}}
                        </span>
                    </div>
                    <div class="col-12 col-lg-5 mb-3 mb-lg-0">
                        <x-input
                            class="border-0 border-bottom rounded-0 bg-primary-light rounded-pill px-4 form-control-lg text-white text-center ph-white"
                            placeholder="CLICK ME TO CHANGE TEXT"
                            x-on:change.debounce.500ms="$wire.onChangeLogic({{ $logic->id }}, $el.value)"
                            :value="$logic->name"
                        />
                    </div>
                    <div class="col-12 col-lg-5 mb-3 mb-lg-0 d-flex justify-content-between align-items-center">
                        <div class="dropdown" @click.away="toggleDropDown = false">
                            <a class="btn btn-outline-{{ $hasLinkedSections ? 'light bg-transparent text-primary-light' : 'light text-dark' }}
                                btn-lg btn-block" href="#" @click.prevent="toggleDropDown = !toggleDropDown" role="button" id="dropdownMenuLink{{ $logic->id }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <img src="{{asset('img/menu-icons/site-map-logic.svg')}}" class="w-18" alt="">
                                <span class="mx-2">If selected show</span>
                                <img src="{{asset('img/menu-icons/arrow-down-logic.svg')}}" class="w-13" alt="">
                            </a>

                            <ul class="dropdown-menu mt-2 shadow-sm " wire:ignore.self aria-labelledby="dropdownMenuLink{{ $logic->id }}" style="border-color: #00000020" :class="{ 'show': toggleDropDown }">

                                @foreach($sectionsToLinkWithLogic as $sectionToLinkWithLogic)
                                    @if($sectionToLinkWithLogic->id !== $stepSection->id && $sectionToLinkWithLogic->display_order > $stepSection->display_order)
                                        <li>
                                            <a
                                                class="dropdown-item {{ $sectionToLinkWithLogic->offer_form_section_logic_id !== null && $sectionToLinkWithLogic->offer_form_section_logic_id !== $logic->id ? 'disabled' : ''}}"
                                                href="#"
                                                wire:click.prevent="onChangeLogicToSection({{ $logic->id }}, {{ $sectionToLinkWithLogic->id }})"
                                            >
                                                @if($sectionToLinkWithLogic->offer_form_section_logic_id === $logic->id)
                                                    <i class="fa fa-check text-primary me-2" aria-hidden="true"></i>
                                                @endif
                                                Section {{ $iteration }}
                                            </a>
                                        </li>
                                    @endif
                                    @php
                                       $iteration += 1;
                                    @endphp
                                @endforeach
                            </ul>

                        </div>

{{--                        @php--}}
{{--                            $sectionsToLinkWithLogic = \App\Models\OfferForms\OfferFormSection::where('offer_form_id', $stepSection->offer_form_id)->get();--}}
{{--                        @endphp--}}

{{--                        <div class="logic-select-input">--}}
{{--                            <select class="selectpicker form-control " multiple data-live-search="true" x-init="$('.selectpicker').selectpicker('refresh');" >--}}
{{--                                @foreach($sectionsToLinkWithLogic as $sectionToLinkWithLogic)--}}
{{--                                    @if($sectionToLinkWithLogic->id !== $stepSection->id && $sectionToLinkWithLogic->display_order >= $stepSection->display_order)--}}
{{--                                        <option--}}
{{--                                            class="{{ $sectionToLinkWithLogic->offer_form_section_logic_id !== null && $sectionToLinkWithLogic->offer_form_section_logic_id !== $logic->id ? 'disabled' : ''}}"--}}
{{--                                            wire:click.prevent="onChangeLogicToSection({{ $logic->id }}, {{ $sectionToLinkWithLogic->id }})"--}}
{{--                                        >--}}
{{--                                              @if($sectionToLinkWithLogic->offer_form_section_logic_id === $logic->id)--}}
{{--                                                <i class="fa fa-check text-primary me-2" aria-hidden="true"></i>--}}
{{--                                            @endif--}}
{{--                                            Section {{ $loop->iteration }}--}}
{{--                                        </option>--}}

{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}


                        <a href="#"
                           wire:click.prevent="onDeleteLogic({{ $logic->id }})"
                           class="text-decoration-none fs-22 ms-1">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @endempty
        <div class="row">
            <div class="offset-0 col-12 offset-lg-2 col-lg-5 pb-2">
                <a href="#" wire:click.prevent="addLogic"
                   class="text-decoration-none addMoreMultipleCheckBoxInput btn btn-lg w-100 text-white btn-primary-lighter fs-18 mb-3 text-uppercase px-5 rounded-pill">
                    Add Logic <img src="{{asset('img/menu-icons/plus-white-icon.svg')}}" class="ms-2" alt="">
                </a>
            </div>
        </div>
    </div>
@else
    @php
        $selectedLogic = offer_form_steps_input_value($stepSection->offerForm->offerForm->slug, $stepSection->id, 'logic');
    @endphp
    <div
        class="row mt-5 {{ count($logics) > 2 ? '' : 'justify-content-center' }}"
        x-data="{ selectedLogic: '{{ $selectedLogic }}'}"
    >
        @foreach($logics as $key => $logic)
            <div class="col-12 col-md-6 col-lg-4 mb-3 d-grid">
                <a href="javascript:void(0)"
                    :class="{ ['btn btn-logic rounded-pill border-0 text-decoration-none text-uppercase rounded']: true, 'btn-form-builder': selectedLogic !== '{{ $logic->id }}', 'btn-primary': selectedLogic === '{{ $logic->id }}' }"
                    @click.prevent="selectedLogic = selectedLogic === '{{ $logic->id }}' ? '-1' :'{{ $logic->id }}'; $wire.onFormInputChange('logic', parseInt(selectedLogic)); console.log(selectedLogic)"
                >
                    {{ $logic->name }}
                </a>
            </div>
        @endforeach
        <div wire:loading wire:target="onFormInputChange" class="rounded" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0, 0.2)">
            <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                <x-spinner style="width: 60px; height: 60px"/>
            </div>
        </div>
    </div>
@endif
