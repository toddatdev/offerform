<div
    x-data="{ yesOrNo{{ $stepSection->id }}: '{{ $this->defaultOrValue }}' }"
    x-init=" yesOrNo{{ $stepSection->id }} = yesOrNo{{ $stepSection->id }} === '' ? null : parseInt(yesOrNo{{ $stepSection->id }})"
    class="btn-group mt-4"
>
    <a
        :class="{ ['btn mx-5 px-4 text-uppercase rounded']: true, 'btn-form-builder': !yesOrNo{{ $stepSection->id }}, 'btn-primary': yesOrNo{{ $stepSection->id }} }"
        href="#"
        @click.prevent="$wire.onFormInputChange('yes_or_no', 1); yesOrNo{{ $stepSection->id }} = 1"
    >
        Yes
    </a>
    <a
        :class="{ ['btn mx-5 px-4 text-uppercase rounded']: true, 'btn-form-builder': yesOrNo{{ $stepSection->id }} === null || yesOrNo{{ $stepSection->id }}, 'btn-primary': yesOrNo{{ $stepSection->id }}  !== null && !yesOrNo{{ $stepSection->id }}}"
        href="#"
        @click.prevent="$wire.onFormInputChange('yes_or_no', 0); yesOrNo{{ $stepSection->id }} = 0"
    >
        No
    </a>
</div>
