<div class="mt-4 w-full-md-75 animationInput">
    <div class="form-group">
        <x-input
            class="text-center ph-lighter outline-none input-data-text-primary-light"
            type="text"
            x-on:change.debounce.100ms="$wire.onFormInputChange('short_answer', $el.value)"
            wire:loading.attr="disabled"
            wire:target="onFormInputChange"
            x-init="$el.value = '{{ $this->defaultOrValue }}'"
            :placeholder="$stepSection->placeholder ?? 'Answer here'"
        />
        <label for="short_answer{{$stepSection->id}}" class="animated-label"></label>
    </div>
</div>
