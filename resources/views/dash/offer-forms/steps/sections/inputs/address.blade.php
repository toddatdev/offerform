@if($routeIsEdit)
    <div class="mt-4 w-full-md-75">
        <div class="form-group">
            <x-input
                wire:ignore
                type="text"
                class="form-control form-control-lg text-center ph-lighter outline-none input-data-text-primary-light"
                id="address{{ $stepSection->id }}"
                x-ref="address{{ $stepSection->id }}"
                :placeholder="$stepSection->placeholder ?? 'Enter Your Property Address Here'"
                wire:loading.attr="disabled"
                wire:target="onFormInputChange"
                x-on:change.debounce.100ms="$wire.onFormInputChange('address', $el.value);"
            />
            <label for="address{{ $stepSection->id }}" class="animated-label"></label>
        </div>
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
    </div>
@else
    <div
        class="mt-4 w-full-md-75"
        x-init="
            googleMaps.load().then(function (google) {
                $refs.address{{ $stepSection->id }}.style.height = '5px';
                var options = {
                    componentRestrictions: { country: 'us' },
                    fields: ['address_components', 'geometry', 'icon', 'name']
                };

                autocomplete = new google.maps.places.Autocomplete($refs.address{{ $stepSection->id }}, options);

                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                   $wire.onFormInputChange('address', $refs.address{{ $stepSection->id }}.value);
                });
            });

            setInterval(() => {
                if ($refs.address{{ $stepSection->id }}){
                    $refs.address{{ $stepSection->id }}.style.height =  $refs.address{{ $stepSection->id }}.scrollHeight + 'px';
                }
            }, 1);
        "
    >
        <div class="form-group">
            <x-textarea
                wire:ignore
                type="text"
                class="form-control form-control-lg text-center ph-lighter outline-none input-data-text-primary-light"
                id="address{{ $stepSection->id }}"
                x-ref="address{{ $stepSection->id }}"
                :placeholder="$stepSection->placeholder ?? 'Enter Your Property Address Here'"
                wire:loading.attr="disabled"
                wire:target="onFormInputChange"
                autocomplete="address-off"
            >{{ $this->defaultOrValue }}</x-textarea>
            <label for="address{{ $stepSection->id }}" class="animated-label"></label>
        </div>
    </div>
@endif
