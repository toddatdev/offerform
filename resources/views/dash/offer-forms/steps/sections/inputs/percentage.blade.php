<div class="mt-4 w-full-md-75">
    @php
        $val = $this->defaultOrValue;
    @endphp
    <div class="input-group form-group">
        <div class="position-relative border w-100 rounded">
            <x-input
                wire:ignore
                class="form-control form-control-lg border-0 outline-none text-center ph-lighter input-data-text-primary-light"
                id="percentage_{{$stepSection->id}}"
                x-ref="percentage_{{$stepSection->id}}_input"
                type="text"
                :placeholder="$stepSection->placeholder ?? 'Enter percentage here'"
                x-on:change.debounce.100ms="$wire.onFormInputChange('percentage', $el.value); $refs.percentage_{{$stepSection->id}}_range.value = parseInt($el.value)"
                x-init="$el.value = '{{ $val === '' ? 0 : $val }}'"
                wire:loading.attr="disabled"
                wire:target="onFormInputChange"
            />
            <label for="percentage_{{$stepSection->id}}" class="animated-label"></label>
            <div class="position-absolute text-center percentageSign bg-transparent border-0 text-primary-light fw-500"
            >%
            </div>

        </div>


    </div>

    <div class="form-group mt-3">
        <x-input
            wire:ignore
            type="range"
            class="form-range border-0 outline-none"
            min="0"
            max="100"
            step="1"

            id="percentage_{{$stepSection->id}}_range"
            x-ref="percentage_{{$stepSection->id}}_range"
            x-on:change.debounce.100ms="$wire.onFormInputChange('percentage', $el.value); $refs.percentage_{{$stepSection->id}}_input.value = parseInt($el.value)"
            x-init="$el.value = '{{ $val === '' ? 0 : $val }}'"
        />

        <div class="d-flex justify-content-between mt-1">
            <div class="fw-bold">0%</div>
            <div class="fw-bold">100%</div>
        </div>
    </div>
</div>
