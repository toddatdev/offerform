<div class="mt-4 w-full-md-75">
    <div class="form-group">
        <x-textarea
            wire:ignore
            type="text"
            x-on:change.debounce.500ms="$wire.onFormInputChange('paragraph', $el.value)"
            :placeholder="$stepSection->placeholder ?? 'Your Long Answer Here'"
            rows="5"
            class="text-center outline-none input-data-text-primary-light"
            wire:loading.attr="disabled"
            wire:target="onFormInputChange"
        >
            {{ $this->defaultOrValue }}
        </x-textarea>
        <label for="paragraph{{$stepSection->id}}" class="animated-label" style="top: 140px !important;"></label>
    </div>
</div>
