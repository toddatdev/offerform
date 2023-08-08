<div class="mt-4 w-full-md-75">
    <div class="form-group">
        <x-input
            wire:ignore
            class="form-control form-control-lg text-center ph-lighter outline-none input-data-text-primary-light {{!$routeIsEdit ? 'autocomplete-email' : ''}}"
            id="email_{{$stepSection->id}}"
            type="email"
            :placeholder="$stepSection->placeholder ?? 'Enter email here'"
            x-on:change="$wire.onFormInputChange('email', $el.value);"
            wire:loading.attr="disabled"
            wire:target="onFormInputChange"
            x-init="$el.value = '{{ $this->defaultOrValue }}'"
        />
        <label for="email{{$stepSection->id}}" class="animated-label"></label>
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
        </fieldset>
    @endif
</div>
