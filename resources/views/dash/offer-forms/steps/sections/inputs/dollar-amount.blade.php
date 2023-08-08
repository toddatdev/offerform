@if($routeIsEdit)
    <div
        class="mt-4 w-full-md-75"
        x-data="{
            slider: 0,
        }"
        id="dollar-amount{{$this->stepSection->id}}"
    >
        <div class="input-group form-group">
            <div class="position-relative border w-100 rounded">
                    <x-input
                        type="text"
                        id="dollar_amount_{{$stepSection->id}}_input"
                        x-ref="dollar_amount_{{$stepSection->id}}_input"
                        :placeholder="$stepSection->placeholder ?? '$ Enter dollar amount here'"
                        class="text-center border-0 outline-none ph-lighter input-data-text-primary-light"
                        x-on:change.debounce.500ms="$wire.onFormInputChange('dollar_amount', $el.value); "
                        wire:loading.attr="disabled"
                        wire:target="onFormInputChange"
                    />
                    <label for="dollar_amount_{{$stepSection->id}}_input" class="animated-label"></label>
            </div>
        </div>
            <div class="form-group mt-3">
                <x-input
                    type="range"
                    class="form-range border-0 outline-none "
                    step="10000"
                    min="0"
                    max="100000"
                    id="dollar_amount_{{$stepSection->id}}_range"
                    x-ref="dollar_amount_{{$stepSection->id}}_range"
                    x-model="slider"
                />
            </div>

    </div>
@elseif($routeIsPreview)
    <div
        class="mt-4 w-full-md-75"
        x-data="{
            slider: 0,
            range: '',
            sliderRange: 1000000,
        }"
        x-init="
            $watch('range', (val) => {
                val = val.replace('$', '');
                if (val !== '') {
                    range = '$' + (parseInt(val.replaceAll(',','').replace('$','')).toLocaleString());
                    sliderRange =  parseInt(val.replaceAll(',','').replace('$','')) * 2;
                    slider = parseInt(val.replaceAll(',','').replace('$',''));
                } else {
                    slider = 0;
                    range  = '';
                    sliderRange = 1000000;
                }

            })
        "
        id="dollar-amount{{$this->stepSection->id}}"
    >
        <div class="input-group form-group">
            <div class="position-relative border w-100 rounded">
                <x-input
                    type="text"
                    id="dollar_amount_{{$stepSection->id}}_input"
                    x-ref="dollar_amount_{{$stepSection->id}}_input"
{{--                    x-mask="{numeral: true, prefix: '$', numeralIntegerScale: 10, numeralPositiveOnly: true}"--}}
                    :placeholder="$stepSection->placeholder ?? '$ Enter dollar amount here'"
                    x-model="range"
                    class="text-center border-0 outline-none ph-lighter input-data-text-primary-light"
                />
                <label for="dollar_amount_{{$stepSection->id}}_input" class="animated-label"></label>
            </div>
        </div>

        <div class="form-group mt-3">
            <x-input
                type="range"
                class="form-range border-0 outline-none "
                step="10000"
                min="0"
                x-bind:max="sliderRange"
                x-on:change="$el.value !== '0'? range = $el.value : range = ''"
                id="dollar_amount_{{$stepSection->id}}_range"
                x-ref="dollar_amount_{{$stepSection->id}}_range"
                x-model="slider"
            />
        </div>
    </div>
@else
    @php
        $val = sanitize_number_int($this->defaultOrValue);
    @endphp
    @php
        $sliderMax = intval(str_replace(',', '', $val)) * 2;
    @endphp
    <div
        class="mt-4 w-full-md-75"
        x-data="{
            slider: {{ $val }},
            range: '{{ $val }}',
            sliderRange: {{ $sliderMax }},
            initValues(val) {
                val = val.replace('$', '');
                if (val !== '' && val !== '0') {
                    this.range = '$' + (parseInt(val.replaceAll(',','').replace('$','')).toLocaleString());
                    this.sliderRange = parseInt(val.replaceAll(',','').replace('$','')) * 2;
                    this.slider = parseInt(val.replaceAll(',','').replace('$',''));
                } else {
                    this.slider = 0;
                    this.range  = '';
                    this.sliderRange = {{ $sliderMax }};
                }
            }
        }"
        x-init="
            initValues('{{ $val }}');
            $watch('range', (val) => {
                initValues(val);
            });

            $watch('slider', (val) => {
                initValues(val);
            });
        "
        id="dollar-amount{{$this->stepSection->id}}"
        wire:ignore.self
    >
        <div class="input-group form-group">
            <div class="position-relative border w-100 rounded">
                <x-input
                    type="text"
                    id="dollar_amount_{{$stepSection->id}}_input"
                    x-ref="dollar_amount_{{$stepSection->id}}_input"
                    x-model="range"
                    x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
                    :placeholder="$stepSection->placeholder ?? '$ Enter dollar amount here'"
                    x-on:input.change.debounce.1000ms="$wire.onFormInputChange('dollar_amount', $el.value.replace('$', '')); initValues($el.value)"
                    class="text-center border-0 outline-none ph-lighter input-data-text-primary-light"
                    wire:loading.attr="disabled"
                    wire:target="onFormInputChange"
                />
                <label for="dollar_amount_{{$stepSection->id}}_input" class="animated-label"></label>
            </div>
        </div>

        <div class="form-group mt-3">
            <x-input
                type="range"
                class="form-range border-0 outline-none "
                step="1000"
                min="0"
                max="{{ $sliderMax === 0 ? 100000 : $sliderMax}}"
                id="dollar_amount_{{$stepSection->id}}_range"
                x-ref="dollar_amount_{{$stepSection->id}}_range"
                x-on:change.debounce.500ms="$wire.onFormInputChange('dollar_amount', $el.value !== '0'? $el.value : '' );"
                x-model="slider"
            />
        </div>
    </div>
@endif


