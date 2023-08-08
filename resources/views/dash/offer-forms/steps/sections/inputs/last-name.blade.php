<div class="mt-4 w-full-md-75">
    <div class="form-group">
        <x-input
            wire:ignore
            class="form-control form-control-lg text-center ph-lighter outline-none input-data-text-primary-light"
            id="last_name_{{$stepSection->id}}"
            :placeholder="$stepSection->placeholder ?? 'Your last name'"
            type="text"
            wire:loading.attr="disabled"
            wire:target="onFormInputChange"
            x-on:change.debounce.500ms="$wire.onFormInputChange('last_name', $el.value);"
            x-init="$el.value = '{{ $this->defaultOrValue }}'"
        />
        <label for="last_name{{$stepSection->id}}" class="animated-label"></label>
    </div>
    @if($routeIsEdit)
        <fieldset
            x-data="{
                isVariable: !!{{ $stepSection->type_config['is_variable'] ?? 0  }},
                buyer1stOr2nd: '{{ $stepSection->type_config['buyer_1st_or_2nd'] ?? '1st' }}'
            }">
            <legend>
                <div class="form-check">
                    <label class="form-check-label fw-normal fs-6" for="is_variable_{{ $stepSection->id }}" style="cursor: pointer">
                        <input
                            class="form-check-input fs-6"
                            type="checkbox"
                            x-model="isVariable"
                            id="is_variable_{{ $stepSection->id }}"
                            x-on:input.change.debounce.50ms="$wire.onChangeSectionTypeConfig('is_variable', $el.checked ? 1 : 0)"
                        />
                        Is Variable
                    </label>
                </div>
            </legend>
            <div class="d-flex justify-content-center align-items-center">
                <label class="me-2 fw-bold">Buyer:</label>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="1st_buyer_{{ $stepSection->id }}" style="cursor: pointer">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="var_buyer_{{ $stepSection->id }}"
                            id="1st_buyer_{{ $stepSection->id }}"
                            value="1st"
                            x-model="buyer1stOr2nd"
                            x-on:input.change.debounce.50ms="$wire.onChangeSectionTypeConfig('buyer_1st_or_2nd', $el.value)"
                            checked
                            x-bind:disabled="!isVariable"
                        />
                        1st
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="2nd_buyer_{{ $stepSection->id }}" style="cursor: pointer">
                        <input
                            class="form-check-input"
                            type="radio"
                            x-model="buyer1stOr2nd"
                            name="var_buyer_{{ $stepSection->id }}"
                            id="2nd_buyer_{{ $stepSection->id }}"
                            x-on:input.change.debounce.50ms="$wire.onChangeSectionTypeConfig('buyer_1st_or_2nd', $el.value)"
                            value="2nd"
                            x-bind:disabled="!isVariable"
                        />
                        2nd
                    </label>
                </div>
            </div>
        </fieldset>
    @endif
</div>
