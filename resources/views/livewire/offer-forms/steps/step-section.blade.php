@push('stylesheets')
    <style>

        .required-form-check-input {
            margin-top: 5px;
            width: 32px !important;
            height: 16px !important;
        }

        .required-form-check-input:checked {
            margin-top: 5px;
            width: 32px !important;
            height: 16px !important;
        }
    </style>


@endpush

@inject('offerFormSection', '\App\Models\OfferForms\OfferFormSection')

{{--<div class="container form-builder"--}}
{{--     @if($routeIsEdit && $stepSection->offerForm->need_to_upgrade === 0) wire:sortable.item="{{ $stepSection->id }}" @endif--}}
{{--       Step active indicator initialization--}}
{{--     x-data="{stepActive{{ $stepSection->id }}: false, editingSectionName{{ $stepSection->id }}: false}"--}}
{{--     id="step-section-{{ $stepSection->id }}"--}}
{{-->--}}

{{--    <div--}}
{{--        class="card border-0 bg-primary-light shadow  max-width-980 mx-auto"--}}
{{--           Step active indicator functioning--}}
{{--         @if(in_array($stepSection->type, ['inputs', 'infos']))--}}
{{--         class="card shadow form-builder-card border-0 max-width-980 mx-auto bg-primary-light scrollOnClickAttachToolBar requiredFieldMessage{{ $stepSection->id }}"--}}
{{--         id="requiredFieldMessage{{ $stepSection->id }}"--}}
{{--         :class="{'form-builder-card-active': stepActive{{ $stepSection->id }}}"--}}
{{--         @click="stepActive{{ $stepSection->id }} = true" @click.away="stepActive{{ $stepSection->id }} = false"--}}
{{--         @else--}}
{{--         class="shadow form-builder-card bg-white"--}}
{{--         style="border-left: none !important;"--}}
{{--        @endif--}}
{{--    >--}}

{{--         CollapseAble Row--}}

{{--        @if($routeIsEdit)--}}
{{--            <div class="row text-center text-white px-3  py-3 my-auto">--}}

{{--            <div class="col-3 col-lg-1 text-start text-lg-end align-self-center">--}}
{{--                <i class="fa fa-question-circle fa-2x" aria-hidden="true"></i>--}}
{{--            </div>--}}

{{--            <div class="col-9 col-lg-4 text-end text-lg-center align-self-center text-start"><img--}}
{{--                    src="{{asset('img/menu-icons/selected-option-icon.svg')}}" class="w-26 me-2" alt=""> {{ $stepSection->title }}--}}
{{--            </div>--}}

{{--            <div class="col-12 col-lg-2 align-self-center">--}}
{{--                <img src="{{asset('img/agent/categories/cat-grid.svg')}}"--}}
{{--                     wire:sortable.handle--}}
{{--                     style="cursor: move"--}}
{{--                     class="w-26" alt="">--}}
{{--            </div>--}}

{{--            <div class="col-6 col-lg-3 text-start text-lg-center  align-self-center">--}}
{{--                Section: {{ $loopIndex + 1 }}--}}
{{--            </div>--}}

{{--            <div class="col-6 col-lg-2 text-end text-lg-center  align-self-center">--}}
{{--                <a class="text-decoration-none text-uppercase fs-16 fw-bold text-white" data-bs-toggle="collapse"--}}
{{--                   href="#collapse{{ $stepSection->id }}Section" role="button" aria-expanded="false" aria-controls="collapse{{ $stepSection->id }}Section">--}}
{{--                    Expand <img src="{{asset('img/menu-icons/expand-arrow.svg')}}" class="w-20 ms-2" alt="">--}}
{{--                </a>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        @endif--}}
{{--         End CollapseAble Row--}}


{{--        <div class="collapse show collapsedOrExpandSection" id="collapse{{ $stepSection->id }}Section">--}}

{{--            <div class="card card-body border-0 text-center mt-0-65 mt-0-62 attachToolBarSection"--}}
{{--                 data-id= {{ $loopIndex + 1 }}>--}}

{{--                @includeWhen(in_array($stepSection->type, ['inputs', 'infos']), 'livewire.offer-forms.partials.step-section.new-offer-form-header')--}}

{{--                @if(!$routeIsEdit && in_array($stepSection->type, ['inputs', 'infos']))--}}
{{--                    <br/>--}}
{{--                    <br/>--}}
{{--                @endif--}}

{{--                 Section Image  Start--}}
{{--                @includeWhen($stepSection->image && in_array($stepSection->type, ['inputs', 'infos']), 'livewire.offer-forms.partials.step-section.image')--}}
{{--                 Section Image  End--}}

{{--                                      Section Short & Long Description [Start]--}}
{{--                @includeWhen(in_array($stepSection->type, ['inputs', 'infos']), 'livewire.offer-forms.partials.step-section.short-and-long-description')--}}
{{--                                      Section Short & Long Description [End]--}}

{{--                <div class="{{ in_array($stepSection->type, ['inputs']) ? 'mb-5' : 'mb-0'}}">--}}
{{--                     Load views for specific config as selected from section footer input selection--}}
{{--                    @isset($stepSection->type_config['view'])--}}
{{--                        @includeIf("dash.offer-forms.steps.sections.{$stepSection->type}.{$stepSection->type_config['view']}")--}}
{{--                        @isset($requiredFieldsNotFilled[$stepSection->id])--}}
{{--                            <div class="text-end mt-2 w-full-md-75">--}}
{{--                            <span class="text-primary-light border p-1 fw-bold">--}}
{{--                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>This field is required--}}
{{--                            </span>--}}
{{--                            </div>--}}
{{--                        @endisset--}}
{{--                    @endisset--}}
{{--                </div>--}}

{{--                 If section has go to the next statement enabled or set then allow editing and show  [Start]--}}
{{--                @includeWhen($stepSection->go_to_the_next, 'livewire.offer-forms.partials.step-section.go-to-the-next')--}}
{{--                If section has go to the next statement enabled or set then allow editing and show  [End]--}}


{{--                @if(!$routeIsEdit && in_array($stepSection->type, ['inputs', 'infos']))--}}
{{--                    <br/>--}}
{{--                    <br/>--}}
{{--                @endif--}}

{{--                @if($routeIsEdit && $stepSection->type === 'inputs')--}}

{{--                    <div class="row mb-2 w-full-md-75 px-0">--}}
{{--                        <div class="col-12 col-md-6 col-lg-6 mb-3 mb-lg-0 ps-md-0 ps-lg-0">--}}

{{--                            <div class="mb-2 ps-lg-0">--}}
{{--                                @if(is_null($stepSection->title) || $stepSection->title === '')--}}
{{--                                    <p class="border w-100-lg-85 text-center fs-14 text-primary fw-500 alert-icon">Question must be named</p>--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            <a href="#"--}}
{{--                               @click.prevent="editingSectionName{{ $stepSection->id }} = true; setTimeout(() => $refs.stepSection_title.focus(), 250)"--}}
{{--                               x-show="!editingSectionName{{ $stepSection->id }}"--}}
{{--                               class="text-white text-decoration-none fs-16 btn btn-primary-light d-block edit-left-icon"--}}
{{--                               :class="{'d-block': !editingSectionName{{ $stepSection->id }}}"--}}
{{--                               style="cursor: pointer;"--}}
{{--                            >--}}
{{--                                {{ $stepSection->title ?? 'Click To Name Question' }}--}}

{{--                            </a>--}}
{{--                              Section title input--}}
{{--                            <input--}}
{{--                                id="stepSection_title{{ $stepSection->id }}"--}}
{{--                                class="form-control form-control-sm mx-auto text-center text-primary text-decoration-none fs-16"--}}
{{--                                placeholder="Type here to name question"--}}
{{--                                style="display: none"--}}
{{--                                x-ref="stepSection_title"--}}
{{--                                name="stepSection.title{{ $stepSection->id }}"--}}
{{--                                wire:model.defer="stepSection.title"--}}
{{--                                x-show="editingSectionName{{ $stepSection->id }}"--}}
{{--                                @click.away="editingSectionName{{ $stepSection->id }} = false; $wire.onChangeSection()"--}}
{{--                            />--}}

{{--                        </div>--}}
{{--                        <div class="col-12 col-md-6 col-lg-6 mb-3 mb-lg-0 pe-md-0 pe-lg-0">--}}

{{--                            <div class="mb-2">--}}
{{--                                @if(is_null($stepSection->category_id))--}}
{{--                                    <p class="border w-100-lg-85 text-center fs-14 text-primary fw-500 alert-icon">Question must be categorized</p>--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            @if(!in_array($typeConfigType, ['mortgage-calculator', 'seller-financing', 'cost-calculator']))--}}
{{--                                <div class="dropdown d-grid border rounded">--}}
{{--                                    <button class="btn text-start text-white bg-primary-light select-arrow-down" type="button"--}}
{{--                                            id="categoryDropdownMenuButton{{ $stepSection->id }}"--}}
{{--                                            data-bs-toggle="dropdown" aria-expanded="false" style="margin-right: 0 !important;">--}}
{{--                                        @if($stepSection->category)--}}
{{--                                            @if($stepSection->category->image)--}}
{{--                                                <img class="w-24 me-3" src="{{ asset("storage/{$stepSection->category->image}") }}" style="filter:  brightness(0) invert(1); -webkit-filter: brightness(0) invert(1);"--}}
{{--                                                     alt="{{ $stepSection->category->name }}"/>--}}
{{--                                            @endif--}}
{{--                                            {{ $stepSection->category->name }}--}}
{{--                                        @else--}}
{{--                                            <img class="w-24 me-3" src="{{asset('img/dash/offer-forms/category.svg')}}" style="filter:  brightness(0) invert(1); -webkit-filter: brightness(0) invert(1);"--}}
{{--                                                 alt="Click to Categorize Question" /> Click to Categorize Question--}}
{{--                                        @endif--}}
{{--                                    </button>--}}
{{--                                    <ul class="dropdown-menu shadow-lg w-100 mt-2 select-offer-form-category  rounded-3 mt-4 scrollbarMenu"--}}
{{--                                        style="z-index: 9999"--}}
{{--                                        aria-labelledby="categoryDropdownMenuButton{{ $stepSection->id }}">--}}
{{--                                                                            <li>--}}
{{--                                                                                <a class="dropdown-item" href="#" wire:click.debounce.1000ms="onChangeSection"--}}
{{--                                                                                   @click.prevent="$wire.set('stepSection.category_id', null);">--}}
{{--                                                                                    <img class="w-18 me-3 svg-hover-list"--}}
{{--                                                                                         src="{{asset('img/dash/offer-forms/dash.svg')}}"--}}
{{--                                                                                         alt="Not Categorized"> Not Categorized--}}
{{--                                                                                </a>--}}
{{--                                                                            </li>--}}
{{--                                        @foreach(\App\Models\Category::getQuery() as $category)--}}
{{--                                            <li>--}}
{{--                                                <a--}}
{{--                                                    class="dropdown-item"--}}
{{--                                                    href="#"--}}
{{--                                                    wire:click.prevent="onChangeSectionCategory({{ $category->id }})"--}}
{{--                                                                                                @click.prevent="$wire.set('stepSection.category_id', '{{ $category->id }}'); setTimeout(() => {$wire.onChangeSection()}, 500)"--}}
{{--                                                >--}}
{{--                                                    <img class="w-18 me-2 svg-hover-list"--}}
{{--                                                         src="{{asset("storage/$category->image")}}"--}}
{{--                                                         alt=""> {{ $category->name }}--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}

{{--                                    </ul>--}}
{{--                                </div>--}}

{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                    If route is editing then allow footer accordingly [Start]--}}
{{--                @includeWhen($routeIsEdit && in_array($stepSection->type, ['inputs', 'infos']) && !str_contains($stepSection->slug, '-buyer-personal-info-'), 'livewire.offer-forms.partials.step-section.footer')--}}
{{--                    If route is editing then allow footer accordingly [End]--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</div>--}}



{{--Old Form Step--}}

<div
    class="container form-builder"
      When route is edit then allow sorting
    @if($routeIsEdit && $stepSection->offerForm->need_to_upgrade === 0) wire:sortable.item="{{ $stepSection->id }}" @endif
      Step active indicator initialization
    x-data="{stepActive{{ $stepSection->id }}: false, editingSectionName{{ $stepSection->id }}: false}"
    id="step-section-{{ $stepSection->id }}"
>
    <div
          Step active indicator functioning
        @if(in_array($stepSection->type, ['inputs', 'infos']))
            class="card shadow form-builder-card border-0 py-2 px-1 px-lg-3 scrollOnClickAttachToolBar requiredFieldMessage{{ $stepSection->id }}"
        id="requiredFieldMessage{{ $stepSection->id }}"
            :class="{'form-builder-card-active': stepActive{{ $stepSection->id }}}"
            @click="stepActive{{ $stepSection->id }} = true" @click.away="stepActive{{ $stepSection->id }} = false"
        @else
            class="shadow form-builder-card bg-white"
            style="border-left: none !important;"
        @endif
    >

        <div class="card-body text-center p-0 attachToolBarSection"   data-id= {{ $loopIndex + 1 }}>
            @includeWhen(in_array($stepSection->type, ['inputs', 'infos']), 'livewire.offer-forms.partials.step-section.header')

            @if(!$routeIsEdit && in_array($stepSection->type, ['inputs', 'infos']))
                <br/>
                <br/>
            @endif

{{--              Section Imagege  Start--}}
            @includeWhen($stepSection->image && in_array($stepSection->type, ['inputs', 'infos']), 'livewire.offer-forms.partials.step-section.image')
{{--              Section Imagege  End--}}

{{--              Section Short & Long Description [Start]--}}
            @includeWhen(in_array($stepSection->type, ['inputs', 'infos']), 'livewire.offer-forms.partials.step-section.short-and-long-description')
{{--              Section Short & Long Description [End]--}}

            <div class="{{ in_array($stepSection->type, ['inputs']) ? 'mb-5' : 'mb-0'}}">
{{--                     Load views for specific config as selected from section footer input selection--}}
                @isset($stepSection->type_config['view'])
                    @includeIf("dash.offer-forms.steps.sections.{$stepSection->type}.{$stepSection->type_config['view']}")
                    @isset($requiredFieldsNotFilled[$stepSection->id])
                        <div class="text-end w-full-md-75 {{ in_array($stepSection->getSubType(), ['date']) ? 'mt-70' : 'mt-2'}} ">
                            <span class="text-primary-light border p-1 fw-bold">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>This field is required
                            </span>
                        </div>
                    @endisset
                @endisset
            </div>
{{--                  If section has go to the next statement enabled or set then allow editing and show  [Start]--}}
            @includeWhen($stepSection->go_to_the_next, 'livewire.offer-forms.partials.step-section.go-to-the-next')

            @if($routeIsEdit && $stepSection->type === 'inputs')

                <div class="row mb-2 w-full-md-75 px-0 mt-70">

                    <div class="col-12 col-md-6 col-lg-6 mb-3 mb-lg-0 ps-md-0 ps-lg-0 d-none d-lg-block">
                        <div class="mb-2 ps-lg-0">
                            @if(is_null($stepSection->title) || $stepSection->title === '')
                                <p class="border w-100-lg-85 text-center fs-14 text-primary fw-500 alert-icon">Question must be named</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-3 mb-lg-0 ps-md-0 ps-lg-0 d-none d-lg-block">
                        <div class="mb-2">
                            @if(is_null($stepSection->category_id))
                                <p class="border w-100-lg-85 text-center fs-14 text-primary fw-500 alert-icon">Question must be categorized</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 mb-3 mb-lg-0 ps-md-0 ps-lg-0">

                        <div class="mb-2 ps-lg-0 d-block d-lg-none">
                            @if(is_null($stepSection->title) || $stepSection->title === '')
                                <p class="border w-100-lg-85 text-center fs-14 text-primary fw-500 alert-icon">Question must be named</p>
                            @endif
                        </div>

                        <a href="#"
                           @click.prevent="editingSectionName{{ $stepSection->id }} = true; setTimeout(() => $refs.stepSection_title.focus(), 250)"
                           x-show="!editingSectionName{{ $stepSection->id }}"
                           class="text-white text-decoration-none fs-16 btn btn-primary-light d-block edit-left-icon"
                           :class="{'d-block': !editingSectionName{{ $stepSection->id }}}"
                           style="cursor: pointer;"
                        >
                            {{ $stepSection->title ?? 'Click To Name Question' }}

                        </a>
{{--                          Section title input--}}
                        <input
                            id="stepSection_title{{ $stepSection->id }}"
                            class="form-control form-control-sm mx-auto text-center text-primary text-decoration-none fs-16"
                            placeholder="Type here to name question"
                            style="display: none"
                            x-ref="stepSection_title"
                            name="stepSection.title{{ $stepSection->id }}"
                            wire:model.defer="stepSection.title"
                            x-show="editingSectionName{{ $stepSection->id }}"
                            @click.away="editingSectionName{{ $stepSection->id }} = false; $wire.onChangeSection()"
                        />

                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-3 mb-lg-0 pe-md-0 pe-lg-0">

                        <div class="mb-2 d-block d-lg-none">
                            @if(is_null($stepSection->category_id))
                                <p class="border w-100-lg-85 text-center fs-14 text-primary fw-500 alert-icon">Question must be categorized</p>
                            @endif
                        </div>

                        @if(!in_array($typeConfigType, ['mortgage-calculator', 'seller-financing', 'cost-calculator']))
                            <div class="dropdown d-grid border rounded">
                                <button class="btn text-start text-white bg-primary-light select-arrow-down" type="button"
                                        id="categoryDropdownMenuButton{{ $stepSection->id }}"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="margin-right: 0 !important;">
                                    @if($stepSection->category)
                                        @if($stepSection->category->image)
                                            <img class="w-24 me-3" src="{{ asset("storage/{$stepSection->category->image}") }}" style="filter:  brightness(0) invert(1); -webkit-filter: brightness(0) invert(1);"
                                                 alt="{{ $stepSection->category->name }}"/>
                                        @endif
                                        {{ $stepSection->category->name }}
                                    @else
                                        <img class="w-24 me-3" src="{{asset('img/dash/offer-forms/category.svg')}}" style="filter:  brightness(0) invert(1); -webkit-filter: brightness(0) invert(1);"
                                             alt="Click to Categorize Question" /> Click to Categorize Question
                                    @endif
                                </button>
                                <ul class="dropdown-menu shadow-lg w-100 mt-2 select-offer-form-category  rounded-3 mt-4 scrollbarMenu"
                                    style="z-index: 9999"
                                    aria-labelledby="categoryDropdownMenuButton{{ $stepSection->id }}">
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click.debounce.1000ms="onChangeSection"
                                           @click.prevent="$wire.set('stepSection.category_id', null);">
                                            <img class="w-18 me-3 svg-hover-list"
                                                 src="{{asset('img/dash/offer-forms/dash.svg')}}"
                                                 alt="Not Categorized"> Not Categorized
                                        </a>
                                    </li>
                                    @foreach(\App\Models\Category::getQuery() as $category)
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                wire:click.prevent="onChangeSectionCategory({{ $category->id }})"
                                                                                            @click.prevent="$wire.set('stepSection.category_id', '{{ $category->id }}'); setTimeout(() => {$wire.onChangeSection()}, 500)"
                                            >
                                                <img class="w-18 me-2 svg-hover-list"
                                                     src="{{asset("storage/$category->image")}}"
                                                     alt=""> {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>

                        @endif
                    </div>
                </div>
            @endif
{{--                  If section has go to the next statement enabled or set then allow editing and show  [End]--}}
            @if(!$routeIsEdit && in_array($stepSection->type, ['inputs', 'infos']))
                <br/>
                <br/>
            @endif
        </div>

{{--            If route is editing then allow footer accordingly [Start]--}}
        @includeWhen($routeIsEdit && $stepSection->offerForm->need_to_upgrade === 0 && in_array($stepSection->type, ['inputs', 'infos']) && !str_contains($stepSection->slug, '-buyer-personal-info-'), 'livewire.offer-forms.partials.step-section.footer')
{{--            If route is editing then allow footer accordingly [End]--}}
    </div>
    @if($routeIsEdit && $stepSection->offerForm->need_to_upgrade === 0 && str_contains($stepSection->slug, '-buyer-personal-info-3'))
        <div
            class="bg-danger py-2 form-builder-card border-0 py-2 px-1 px-lg-3 shadow"
            style="border-left: none !important"
        >
            <a
                href="#"
                class="btn btn-link text-decoration-none d-block py-3 text-white"
                data-bs-toggle="modal"
                data-bs-target="#deleteConfirmation{{ $stepSection->id ?? 0 }}Modal"
            >
                <h4 class="mb-0">Delete this Buyer Information Form</h4>
            </a>
        </div>
    @endif
</div>
