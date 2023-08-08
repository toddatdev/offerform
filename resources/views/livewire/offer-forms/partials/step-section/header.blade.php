<div class="text-center form-builder-header mb-2">
    @if($routeIsEdit)
        <p class="mb-0 text-{{ $stepSection->offer_form_section_logic_id !== null ? 'primary' : 'dark' }} font-weight-bold" style="position: absolute; right: 15px">
            @if($stepSection->offer_form_section_logic_id !== null)
                <i class="fa fa-sitemap" aria-hidden="true"></i>
            @endif
            Section: {{ $loopIndex + 1 }}
        </p>
        {{--  Sortable handler image icon  --}}
        <img
            class="img-fluid md-icon mb-3"
            src="{{asset('img/form-builder/icons/grid.svg')}}"
            style="cursor: move"
            alt="{{ $stepSection->title }}"
            wire:sortable.handle
        />
    @elseif(!$routeIsEdit && $stepSection->type === 'inputs')
        <br/>
        {{--  Section title static  --}}
{{--        <p class="text-primary">{{ $stepSection->title }}</p>--}}
    @endif
</div>
