<div style="position:relative;">
    {{--  Section if is editing then show removable icon to remove the image  --}}
    @if($routeIsEdit && $stepSection->offerForm->need_to_upgrade === 0)
        <a
            href="#"
            wire:click.prevent="onChangeSectionImage('remove')"
            style="position: absolute; right: 0; top: -5px;"
            class="bg-primary fs-10 text-white rounded-pill text-decoration-none px-2 py-1"
        >
            <div wire:loading wire:target="onChangeSectionImage('remove')">
                <x-spinner style="width: 10px; height: 10px"/>
            </div>
            <i class="fa fa-times fs-12" aria-hidden="true" wire:loading.remove wire:target="onChangeSectionImage('remove')"></i>
            <span wire:loading.remove wire:target="onChangeSectionImage('remove')">
                            Remove
                        </span>
            <span wire:loading wire:target="onChangeSectionImage('remove')">
                            Removing
                        </span>
        </a>
    @endif
    {{-- Section Image --}}
    <img src="{{ asset("storage/{$stepSection->image}") }}" class="img-fluid mb-3 mt-2"/>
</div>
