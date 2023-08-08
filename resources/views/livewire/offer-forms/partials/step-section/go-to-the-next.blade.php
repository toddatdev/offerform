<div class="text-center mt-5 mb-3" style="position:relative;">
    {{--          If route is edit then allow editing          --}}
    @if($routeIsEdit && $stepSection->offerForm->need_to_upgrade === 0)
        {{--           Allow to remove the go to the next statment             --}}
        <a
            href="#"
            wire:click.prevent="goToTheNext()"
            style="position: absolute; right: 0; top: -18px;"
            class="bg-primary fs-10 text-white rounded-pill text-decoration-none px-2 py-1"
        >
            <div wire:loading wire:target="goToTheNext">
                <x-spinner style="width: 10px; height: 10px"/>
            </div>
            <i class="fa fa-times fs-12" aria-hidden="true" wire:loading.remove wire:target="goToTheNext"></i>
            <span wire:loading.remove wire:target="goToTheNext">
                            Remove
                        </span>
            <span wire:loading wire:target="goToTheNext">
                            Removing
                        </span>
        </a>
        {{--             Allow to change the text of go to the next statement           --}}
        <input
            id="stepSection_go_to_the_next{{ $stepSection->id }}"
            class="form-control form-control-sm mx-auto text-center text-primary fs-16 border-0"
            placeholder="Type your section bottom line here...."
            name="stepSection.go_to_the_next{{ $stepSection->id }}"
            wire:model="stepSection.go_to_the_next"
            wire:change.debounce.500ms="onChangeSection"
        />
    @else
        {{--           Show statically go to the next statement to buyer             --}}
        <p class="text-primary">{{ $stepSection->go_to_the_next }}</p>
    @endif

    {{--           Go to the next statement bottom down arrows             --}}
    <a href="javascript:void(0)" class="scrollBottomSectionButton" data-id= {{ $loopIndex + 1 }} >
        <i class="fa fa-angle-double-down fa-2x text-muted fs-22"
           aria-hidden="true"></i>
    </a>
</div>
