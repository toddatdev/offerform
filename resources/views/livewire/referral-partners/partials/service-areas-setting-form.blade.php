<form
    class="card border-0 mb-4 shadow-sm p-3"
    wire:submit.prevent="saveServiceAreas"
    x-data="{
        initSelects() {
                $('#service_areas_states').select2().on('change', function (e) {
                    $wire.set('state.states', $(this).val());
                });

                $('#service_areas_cities').select2().on('change', function (e) {
                    $wire.set('state.cities', $(this).val(), true);
                });

                $('#service_areas_zipcodes').select2({
                    ajax: {
                        url: '{{ route('dash.world.zipcodes') }}',
                        processResults: function (data) {
                          // Transforms the top-level key of the response object from 'items' to 'results'

                          return {
                            results:  data.map(dt => ({id: dt.zipcode, text: dt.zipcode}))
                          };
                        }
                  }
                }).on('change', function (e) {
                    $wire.set('state.zipcodes', $(this).val(), true);
                });
        }
    }"
    x-init="
        $(document).ready(function () {
            initSelects();
         });
        window.livewire.on('loadselectpicker', () => {
             $('#service_areas_cities').select2().on('change', function (e) {
                @this.set('state.cities', $(this).val(), true);
             });
            $('#service_areas_cities').trigger('change');
        });
    "
    wire:ignore.self
>
    <div class="card-body">
        <div class=" d-flex align-items-center">
            <input class="form-check-input me-2 my-0" type="radio" name="service_areas_only" id="state_only"
                   style="height: 18px;width: 18px"
                   value="all"
                   wire:model.defer="state.only"
            />
        <h6 class="fw-bold mb-0">
            Service Areas - <span class="fw-500">Select referral partners service area by State, City, or Zipcode</span>

        </h6>
        </div>
        <div class="row mt-4 mb-2">
            <div class="col-12 col-md-6 col-lg-3 mx-auto">
                <div class="form-group mb-3 px-3" wire:ignore>
                    <label for="" class="fw-bold">State</label>
                    <x-select
                        name="states"
                        wire:model.defer="state.states"
                        class="service_areas_selectpicker"
                        id="service_areas_states"
                        data-live-search="true"
                        multiple
                    >
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </x-select>
                    <div class="d-flex justify-content-between mt-2 mt-md-3">
                        <p class="mb-0 fw-bold">State Only</p>
                        <input class="form-check-input" type="radio" name="service_areas_only" value="states" id="state_only"
                               style="height: 18px;width: 18px"
                               wire:model.defer="state.only"
                        />
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto">
                <div class="form-group mb-3 px-3">
                    <label for="" class="fw-bold">City</label>
                    <x-select
                        name="cities"
                        wire:model.defer="state.cities"
                        id="service_areas_cities"
                        class="service_areas_selectpicker"
                        data-live-search="true"
                        multiple
                    >
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </x-select>
                    <div class="d-flex justify-content-between mt-2 mt-md-3">
                        <p class="mb-0 fw-bold">City Only</p>
                        <input class="form-check-input" type="radio" name="service_areas_only" value="cities" id="city_only"
                               style="height: 18px;width: 18px"
                               wire:model.defer="state.only"
                        />
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mx-auto" wire:ignore>
                <div class="form-group mb-3 px-3">
                    <label for="" class="fw-bold">Zip Code</label>
                    <x-select
                        name="zipcodes"
                        wire:model.defer="state.zipcodes"
                        id="service_areas_zipcodes"
                        class="service_areas_selectpicker"
                        data-live-search="true"
                        multiple
                    >
                        @foreach($zipcodes as $zipcode)
                            <option value="{{ $zipcode->zipcode }}">{{ $zipcode->zipcode }}</option>
                        @endforeach
                    </x-select>
                    <div class="d-flex justify-content-between mt-2 mt-md-3">
                        <p class="mb-0 fw-bold">Zipcode Only</p>
                        <input class="form-check-input" type="radio" name="service_areas_only" value="zipcodes" id="zipcode_only"
                               style="height: 18px;width: 18px"
                               wire:model.defer="state.only"
                        />
                    </div>
                </div>
            </div>
            <div class="text-end mt-4 ">
                <button type="submit" class="btn btn-lg btn-primary-light px-5 rounded-3">SAVE</button>
            </div>
        </div>
    </div>
</form>
