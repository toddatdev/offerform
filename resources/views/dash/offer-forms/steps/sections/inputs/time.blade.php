<div class="mt-4 w-full-md-75">
    <div class="form-group">
        <x-input
            wire:ignore
            class="form-control form-control-lg outline-none input-data-text-primary-light"
            id="time_{{$stepSection->id}}"
            type="time"
            placeholder="Click to enter a time"
            x-on:change.debounce.500ms="$wire.onFormInputChange('time', $el.value);"
            x-init="$el.value = '{{ $this->defaultOrValue }}'"
            wire:loading.attr="disabled"
            wire:target="onFormInputChange"
        />
        <label for="" class="animated-label"></label>
    </div>
</div>
