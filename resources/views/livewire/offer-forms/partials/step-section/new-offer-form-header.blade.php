<div class="text-center form-builder-header mb-2">
    @if($routeIsEdit)

        <div class="d-flex justify-content-between justify-content-lg-end position-sm-unset">
            <p class="mb-0 fw-bold text-{{ $stepSection->offer_form_section_logic_id !== null ? 'primary' : 'dark' }} font-weight-bold">

                @if($stepSection->offer_form_section_logic_id !== null)
                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                @endif

                Section: {{ $loopIndex + 1 }}
            </p>

            <a class="text-decoration-none text-uppercase ms-2 fs-16 fw-bold " data-bs-toggle="collapse"
               href="#collapse{{ $stepSection->id }}Section" role="button" aria-expanded="false" aria-controls="collapse{{ $stepSection->id }}Section">
                Collapse  <img src="{{asset('img/menu-icons/expand-arrow-down.svg')}}" class="w-22 ms-2" alt="">

{{--                <i class="fa fa-arrow-down rounded-circle ms-2 text-white bg-primary-light p-2 mt0-5 "--}}
{{--                             style="transform: rotate(180deg);"></i>--}}
            </a>
        </div>

        {{--  Sortable handler image icon  --}}
        <img
            class="img-fluid md-icon mb-3"
            src="{{asset('img/form-builder/icons/grid.svg')}}"
            style="cursor: move"
            alt="{{ $stepSection->title }}"
            wire:sortable.handle
        />
{{--        @if($stepSection->type === 'inputs')--}}
{{--            <a href="#"--}}
{{--               @click.prevent="editingSectionName{{ $stepSection->id }} = true"--}}
{{--               x-show="!editingSectionName{{ $stepSection->id }}"--}}
{{--               class="text-primary-light text-decoration-none fs-16" style="cursor: pointer;">--}}
{{--                <p>--}}
{{--                    {{ $stepSection->title ?? 'Click here to change question title' }}--}}
{{--                    <img src="{{ asset('img/menu-icons/primary-pencil.svg') }}" class="w-14 ms-3 mt0-5"/>--}}
{{--                </p>--}}
{{--            </a>--}}
{{--            --}}{{--  Section title input  --}}
{{--            <input--}}
{{--                id="stepSection_title{{ $stepSection->id }}"--}}
{{--                class="form-control form-control-sm mx-auto text-center text-primary text-decoration-none fs-16"--}}
{{--                placeholder="Click here to change question title"--}}
{{--                style="width: 300px; display: none"--}}
{{--                name="stepSection.title{{ $stepSection->id }}"--}}
{{--                wire:model="stepSection.title"--}}
{{--                wire:change.debounce.500ms="onChangeSection"--}}
{{--                x-show="editingSectionName{{ $stepSection->id }}"--}}
{{--                @click.away="editingSectionName{{ $stepSection->id }} = false"--}}
{{--            />--}}
{{--        @endif--}}
    @elseif($routeIsEdit && $stepSection->type === 'inputs')
        <br/>
        {{--  Section title static  --}}
        <p class="text-primary">{{ $stepSection->title }}</p>
    @endif
</div>
